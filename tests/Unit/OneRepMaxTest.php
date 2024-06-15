<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\OneRepMax\Lifter;
use App\Models\OneRepMax\Compound;
use App\Services\OneRepMax\OneRepMaxService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OneRepMaxTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Assert that a lifter was created and slug properly created
     */
    public function testProcessStep1()
    {
        $response = $this->post(route('onerepmax.processStep1'), ['name' => 'John Doe']);

        $response->assertRedirect(route('onerepmax.step2', ['lifterSlug' => Lifter::first()->slug]));
        $this->assertDatabaseHas('lifters', ['name' => 'John Doe']);
    }

    /**
     * Assert that an error occurs in case name fails validation
     */
    public function testProcessStep1Fails()
    {
        $response = $this->post(route('onerepmax.processStep1'), ['name' => '']);

        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Assert that lifter data was updated accordingly
     * @return [type]
     */
    public function testProcessStep2()
    {
        $lifter = Lifter::create(['name' => 'John Doe']);
        session(['lifter' => $lifter->slug]);

        $response = $this->post(route('onerepmax.processStep2'), [
            'lifter_slug' => $lifter->slug,
            'height' => 180,
            'weight' => 80,
            'years_of_lifting' => 'up_to_two_years',
            'gender' => 'M'
        ]);

        $response->assertRedirect(route('onerepmax.step3', ['lifterSlug' => $lifter->slug]));
        $this->assertDatabaseHas('lifters', [
            'height' => 180,
            'weight' => 80,
            'years_of_lifting' => 'up_to_two_years',
            'gender' => 'M'
        ]);
    }

    /**
     * Test validation fails for step 2
     */
    public function testProcessStep2Fails()
    {
        $lifter = Lifter::create(['name' => 'John Doe', 'slug' => 'john-doe']);
        session(['lifter' => $lifter->slug]);

        $response = $this->post(route('onerepmax.processStep1'), [
            'lifter_slug' => $lifter->slug,
            'height' => 180,
            'weight' => '',
            'years_of_lifting' => '2',
            'gender' => 'M'
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Test the step 4 process and mock one rep max service
     */
    public function testProcessStep4()
    {
        $compound = Compound::create(['name' => 'compound']);
        $lifter = Lifter::create(['name' => 'lifter']);

        $mockOneRepMaxService = $this->createMock(OneRepMaxService::class);
        $mockOneRepMaxService->expects($this->once())
            ->method('registerLifterRecord')
            ->willReturn(true);

            $this->app->instance(OneRepMaxService::class, $mockOneRepMaxService);

        $inputData = [
            'compoundWeight' => 100,
            'reps' => 10,
            'repsInReserve' => 2,
            'compound_slug' => 'compound',
            'lifter_slug' => 'lifter',
        ];

        $response = $this->post(route('onerepmax.processStep4'), $inputData);

        $response->assertSessionHas('input', $inputData);

        $response->assertRedirect(route('onerepmax.finalStep', [
            'lifterSlug' => $lifter->slug,
            'compoundSlug' => $compound->slug,
        ]));
    }

    /**
     * Test errors
     */
    public function testProcessStep4WithError()
    {
        $compound = Compound::create(['name' => 'compound']);
        $lifter = Lifter::create(['name' => 'lifter']);

        $mockOneRepMaxService = $this->createMock(OneRepMaxService::class);
        $mockOneRepMaxService->expects($this->once())
            ->method('registerLifterRecord')
            ->will($this->throwException(new \Exception('Test exception')));

        $this->app->instance(OneRepMaxService::class, $mockOneRepMaxService);

        $inputData = [
            'compoundWeight' => 100,
            'reps' => 10,
            'repsInReserve' => 2,
            'compound_slug' => 'compound',
            'lifter_slug' => 'lifter',
        ];

        $response = $this->post(route('onerepmax.processStep4'), $inputData);

        // Assert redirection back to the previous page
        $response->assertRedirect();

        // Assert the input data is flashed to the session
        $response->assertSessionHasInput($inputData);

        // Assert an error message is in the session
        $response->assertSessionHasErrors(['error' => 'An error occurred while registering the lifter record.']);
    }
}
