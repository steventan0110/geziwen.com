<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class ApplicantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $plans = [['Early Action', 'EA'],['Early Decision', 'ED'],['Regular Decision', 'RD']];

        $activity_types = [
            "Academic",
            "Art",
            "Athletics: Club",
            "Athletics: JV/Varsity",
            "Career Oriented",
            "Community Service (Volunteer)",
            "Computer/Technology",
            "Cultural",
            "Dance",
            "Debate/Speech",
            "Environmental",
            "Family Responsibilities",
            "Foreign Exchange",
            "Foreign Language",
            "Internship",
            "Journalism/Publication",
            "Junior R.O.T.C.",
            "LGBT",
            "Music: Instrumental",
            "Music: Vocal",
            "Religious",
            "Research",
            "Robotics",
            "School Spirit",
            "Science/Math",
            "Social Justice",
            "Student Govt./Politics",
            "Theater/Drama",
            "Work (Paid)",
            "Other Club/Activity"
        ];

        foreach (range(1, 100) as $i) {
            DB::table('admission_universities')->insert([
                'name' => $faker->name,
                'introduction' => $faker->sentence,
                'location' => $faker->sentence,
            ]);
        }

        foreach ($plans as $plan) {
            DB::table('admission_plans')->insert([
                'name' => $plan[0],
                'shorthand' => $plan[1]
            ]);
        }

        foreach ($activity_types as $type) {
            DB::table('applicant_activity_types')->insert([
                'name' => $type
            ]);
        }

        foreach (range(1, 100) as $i) {

            $plan_id = random_int(1, 30);

            DB::table('applicants')->insert([
                'surname' => $faker->name,
                'plan_id' => $plan_id
            ]);

            if ($plan_id < 16) {
                foreach (range(1, 5) as $j) {
                    DB::table('admission_applications')->insert([
                        'applicant_id' => $i,
                        'university_id' => random_int(1, 100),
                        'plan_id' => random_int(1, 3),
                        'decision_id' => random_int(1, 4)
                    ]);
                }
            }

            if ($plan_id < 16) {
                if (random_int(0, 1)) {
                    // TOEFL
                    DB::table('applicant_exams')->insert([
                        'applicant_id' => $i,
                        'taken_on' => $faker->date(),
                        'type' => 'toefl',
                        'score' => json_encode([
                            'reading' => random_int(10, 30),
                            'listening' => random_int(10, 30),
                            'speaking' => random_int(10, 30),
                            'writing' => random_int(10, 30)
                        ]),
                        'remark' => 'standard'
                    ]);
                }
                else {
                    // IELTS
                    DB::table('applicant_exams')->insert([
                        'applicant_id' => $i,
                        'taken_on' => $faker->date(),
                        'type' => 'ielts',
                        'score' => json_encode([
                            'reading' => random_int(0, 18),
                            'writing' => random_int(0, 18),
                            'listening' => random_int(0, 18),
                            'speaking' => random_int(0, 18)
                        ]),
                        'remark' => 'standard'
                    ]);
                }
                if (random_int(0, 1)) {
                    // SAT
                    DB::table('applicant_exams')->insert([
                        'applicant_id' => $i,
                        'taken_on' => $faker->date(),
                        'type' => 'sat',
                        'score' => json_encode([
                            'reading' => ($r = random_int(10, 40) * 10),
                            'writing' => ($w = random_int(10, 40) * 10),
                            'math' => ($m = random_int(20, 80) * 10),
                            'essay' => [
                                'reading' => random_int(1,8),
                                'writing' => random_int(1,8),
                                'analysis' => random_int(1,8)
                            ],
                            'score' => ($r + $w + $m)
                        ]),
                        'remark' => 'standard'
                    ]);
                }
                else {
                    // ACT
                    DB::table('applicant_exams')->insert([
                        'applicant_id' => $i,
                        'taken_on' => $faker->date(),
                        'type' => 'act',
                        'score' => json_encode([
                            'reading' => random_int(0, 36),
                            'english' => random_int(0, 36),
                            'math' => random_int(0, 36),
                            'science' => random_int(0, 36)
                        ]),
                        'remark' => 'standard',
                    ]);
                }

                foreach (range(1, 3) as $j) {
                    // SAT Subject
                    DB::table('applicant_exams')->insert([
                        'applicant_id' => $i,
                        'taken_on' => $faker->date(),
                        'type' => 'sat2',
                        'score' => json_encode([
                            'subject' => $faker->name,
                            'score' => random_int(20, 80) * 10
                        ]),
                        'remark' => 'standard'
                    ]);
                }

                foreach (range(1, 5) as $j) {
                    // AP
                    DB::table('applicant_exams')->insert([
                        'applicant_id' => $i,
                        'taken_on' => $faker->date(),
                        'type' => 'ap',
                        'score' => json_encode([
                            'subject' => $faker->name,
                            'score' => random_int(1, 5)
                        ]),
                        'remark' => 'standard'
                    ]);
                }
            } else {
                $test_type = random_int(1, 6);
                switch ($test_type) {
                    case 1: {
                        if (random_int(0, 1)) {
                            DB::table('applicant_exams')->insert([
                                'applicant_id' => $i,
                                'taken_on' => $faker->date(),
                                'type' => 'toefl',
                                'score' => json_encode([
                                    'reading' => random_int(10, 30),
                                    'listening' => random_int(10, 30),
                                    'speaking' => random_int(10, 30),
                                    'writing' => random_int(10, 30)
                                ]),
                                'remark' => 'before'
                            ]);
                        }
                        DB::table('applicant_exams')->insert([
                            'applicant_id' => $i,
                            'taken_on' => $faker->date(),
                            'type' => 'toefl',
                            'score' => json_encode([
                                'reading' => random_int(10, 30),
                                'listening' => random_int(10, 30),
                                'speaking' => random_int(10, 30),
                                'writing' => random_int(10, 30)
                            ]),
                            'remark' => 'after'
                        ]);
                        break;
                    }
                    case 2: {
                        if (random_int(0, 1)) {
                            DB::table('applicant_exams')->insert([
                                'applicant_id' => $i,
                                'taken_on' => $faker->date(),
                                'type' => 'ielts',
                                'score' => json_encode([
                                    'reading' => random_int(0, 18),
                                    'writing' => random_int(0, 18),
                                    'listening' => random_int(0, 18),
                                    'speaking' => random_int(0, 18)
                                ]),
                                'remark' => 'before'
                            ]);
                        }
                        DB::table('applicant_exams')->insert([
                            'applicant_id' => $i,
                            'taken_on' => $faker->date(),
                            'type' => 'ielts',
                            'score' => json_encode([
                                'reading' => random_int(0, 18),
                                'writing' => random_int(0, 18),
                                'listening' => random_int(0, 18),
                                'speaking' => random_int(0, 18)
                            ]),
                            'remark' => 'after'
                        ]);
                        break;
                    }
                    case 3: {
                        if (random_int(0, 1)) {
                            DB::table('applicant_exams')->insert([
                                'applicant_id' => $i,
                                'taken_on' => $faker->date(),
                                'type' => 'sat',
                                'score' => json_encode([
                                    'reading' => random_int(10, 40) * 10,
                                    'writing' => random_int(10, 40) * 10,
                                    'math' => random_int(20, 80) * 10,
                                    'essay' => [
                                        'reading' => random_int(1,8),
                                        'writing' => random_int(1,8),
                                        'analysis' => random_int(1,8)
                                    ],
                                ]),
                                'remark' => 'before'
                            ]);
                        }
                        DB::table('applicant_exams')->insert([
                            'applicant_id' => $i,
                            'taken_on' => $faker->date(),
                            'type' => 'sat',
                            'score' => json_encode([
                                'reading' => random_int(10, 40) * 10,
                                'writing' => random_int(10, 40) * 10,
                                'math' => random_int(20, 80) * 10,
                                'essay' => [
                                    'reading' => random_int(1,8),
                                    'writing' => random_int(1,8),
                                    'analysis' => random_int(1,8)
                                ],
                            ]),
                            'remark' => 'after'
                        ]);
                        break;
                    }
                    case 4: {
                        if (random_int(0, 1)) {
                            DB::table('applicant_exams')->insert([
                                'applicant_id' => $i,
                                'taken_on' => $faker->date(),
                                'type' => 'act',
                                'score' => json_encode([
                                    'reading' => random_int(0, 36),
                                    'english' => random_int(0, 36),
                                    'math' => random_int(0, 36),
                                    'science' => random_int(0, 36)
                                ]),
                                'remark' => 'before',
                            ]);
                        }
                        DB::table('applicant_exams')->insert([
                            'applicant_id' => $i,
                            'taken_on' => $faker->date(),
                            'type' => 'act',
                            'score' => json_encode([
                                'reading' => random_int(0, 36),
                                'english' => random_int(0, 36),
                                'math' => random_int(0, 36),
                                'science' => random_int(0, 36)
                            ]),
                            'remark' => 'after',
                        ]);
                        break;
                    }
                    case 5: {
                        DB::table('applicant_exams')->insert([
                            'applicant_id' => $i,
                            'taken_on' => $faker->date(),
                            'type' => 'sat2',
                            'score' => json_encode([
                                'subject' => $faker->name,
                                'score' => random_int(20, 80) * 10
                            ]),
                            'remark' => 'after'
                        ]);
                        break;
                    }
                    case 6: {
                        DB::table('applicant_exams')->insert([
                            'applicant_id' => $i,
                            'taken_on' => $faker->date(),
                            'type' => 'ap',
                            'score' => json_encode([
                                'subject' => $faker->name,
                                'score' => random_int(1, 5)
                            ]),
                            'remark' => 'after'
                        ]);
                        break;
                    }
                }
            }

            foreach (range(1, 5) as $j) {
                DB::table('applicant_awards')->insert([
                    'applicant_id' => $i,
                    'name' => $faker->name,
                    'description' => $faker->text,
                    'received_on' => $faker->date()
                ]);
            }

            foreach (range(1, 10) as $j) {
                DB::table('applicant_activities')->insert([
                    'applicant_id' => $i,
                    'type_id' => random_int(1, count($activity_types)),
                    'name' => $faker->name,
                    'description' => $faker->text,
                    'start' => $faker->date(),
                    'end' => $faker->date(),
                    'hours_per_week' => random_int(1, 7 * 24)
                ]);
            }
        }
    }
}
