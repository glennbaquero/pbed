<?php

use Illuminate\Database\Seeder;

use App\Models\Permissions\PermissionCategory;
use App\Models\Permissions\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Sample Item Management',
                'description' => 'Manage Sample Items',
                'icon' => 'fa fa-cubes',
                'items' => [
                    [
                        'name' => 'admin.sample-items.crud',
                        'description' => 'Manage Sample Items',
                    ],
                ],
            ],
            [
                'name' => 'Admin Management',
                'description' => 'Manage Administrators',
                'icon' => 'fa fa-user-shield',
                'items' => [
                    [
                        'name' => 'admin.admin-users.crud',
                        'description' => 'Manage Administrator Accounts',
                    ],
                    [
                        'name' => 'admin.roles.crud',
                        'description' => 'Manage Admin Roles & Permissions',
                    ],
                ],
            ],
            [
                'name' => 'User Management',
                'description' => 'Manage User Accounts',
                'icon' => 'fa fa-users',
                'items' => [
                    [
                        'name' => 'admin.users.crud',
                        'description' => 'Manage User Accounts',
                    ],
                ],
            ],
            [
                'name' => 'Activity Logs',
                'description' => 'View Activity Logs',
                'icon' => 'fa fa-shield-alt',
                'items' => [
                    [
                        'name' => 'admin.activity-logs.crud',
                        'description' => 'View Activity Logs',
                    ],
                ],
            ],
            [
                'name' => 'Exporting of Reports Management',
                'description' => 'Manage Exporting of Reports',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.reports.index',
                        'description' => 'Viewing of Reports',
                    ],
                     [
                        'name' => 'admin.reports.export',
                        'description' => 'Exporting of Reports',
                    ],
                ],
            ],
            [
                'name' => 'Homepage Slider/First Frame Management',
                'description' => 'Manage Homepage Slider(First Frame)',
                'icon' => 'fa fa-suitcase',
                'items' => [
                     [
                        'name' => 'admin.home-first-frame.index',
                        'description' => 'View Slider',
                    ],
                    [
                        'name' => 'admin.home-first-frame.create',
                        'description' => 'Create Slider',
                    ],
                    [
                        'name' => 'admin.home-first-frame.update',
                        'description' => 'Update Slider',
                    ],
                    [
                        'name' => 'admin.home-first-frame.archive',
                        'description' => 'Archive/Restore Slider',
                    ],
                ],
            ],
            [
                'name' => 'Advocacies Management',
                'description' => 'Manage Advocacies',
                'icon' => 'fa fa-suitcase',
                'items' => [
                     [
                        'name' => 'admin.advocacies.index',
                        'description' => 'View Advocacies',
                    ],
                    [
                        'name' => 'admin.advocacies.create',
                        'description' => 'Create Advocacy',
                    ],
                    [
                        'name' => 'admin.advocacies.update',
                        'description' => 'Update Advocacy',
                    ],
                    [
                        'name' => 'admin.advocacies.archive',
                        'description' => 'Archive/Restore Advocacy',
                    ],
                ],
            ],
            [
                'name' => 'Latest Studies Management',
                'description' => 'Manage Latest Studies',
                'icon' => 'fa fa-suitcase',
                'items' => [
                     [
                        'name' => 'admin.home-latest-study.index',
                        'description' => 'View Latest Studies',
                    ],
                    [
                        'name' => 'admin.home-latest-study.create',
                        'description' => 'Create Latest Study',
                    ],
                    [
                        'name' => 'admin.home-latest-study.update',
                        'description' => 'Update Latest Study',
                    ],
                    [
                        'name' => 'admin.home-latest-study.archive',
                        'description' => 'Archive/Restore Latest Study',
                    ],
                ],
            ],
            [
                'name' => 'News Management',
                'description' => 'Manage News',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.news.index',
                        'description' => 'View News',
                    ],
                    [
                        'name' => 'admin.news.create',
                        'description' => 'Create News',
                    ],
                    [
                        'name' => 'admin.news.update',
                        'description' => 'Update News',
                    ],
                    [
                        'name' => 'admin.news.archive',
                        'description' => 'Archive/Restore News',
                    ],
                ],
            ],
            [
                'name' => 'Events Management',
                'description' => 'Manage Events',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.events.index',
                        'description' => 'View Events',
                    ],
                    [
                        'name' => 'admin.events.create',
                        'description' => 'Create Events',
                    ],
                    [
                        'name' => 'admin.events.update',
                        'description' => 'Update Events',
                    ],
                    [
                        'name' => 'admin.events.archive',
                        'description' => 'Archive/Restore Events',
                    ],
                ],
            ],
            [
                'name' => 'Procurement Management',
                'description' => 'Manage Procurements',
                'icon' => 'fa fa-suitcase',
                'items' => [
                     [
                        'name' => 'admin.procurements.index',
                        'description' => 'View Procurements',
                    ],
                    [
                        'name' => 'admin.procurements.create',
                        'description' => 'Create Procurements',
                    ],
                    [
                        'name' => 'admin.procurements.update',
                        'description' => 'Update Procurements',
                    ],
                    [
                        'name' => 'admin.procurements.archive',
                        'description' => 'Archive/Restore Procurements',
                    ],
                ],
            ],
            [
                'name' => 'Career Management',
                'description' => 'Manage Careers',
                'icon' => 'fa fa-suitcase',
                'items' => [
                     [
                        'name' => 'admin.careers.index',
                        'description' => 'View Careers',
                    ],
                    [
                        'name' => 'admin.careers.create',
                        'description' => 'Create Careers',
                    ],
                    [
                        'name' => 'admin.careers.update',
                        'description' => 'Update Careers',
                    ],
                    [
                        'name' => 'admin.careers.archive',
                        'description' => 'Archive/Restore Careers',
                    ],
                ],
            ],
            [
                'name' => 'Blogs Management',
                'description' => 'Manage Blogs',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.blogs.index',
                        'description' => 'View Blogs',
                    ],
                    [
                        'name' => 'admin.blogs.create',
                        'description' => 'Create Blogs',
                    ],
                    [
                        'name' => 'admin.blogs.update',
                        'description' => 'Update Blogs',
                    ],
                    [
                        'name' => 'admin.blogs.archive',
                        'description' => 'Archive/Restore Blogs',
                    ],
                ],
            ],
            [
                'name' => 'The Challenges (Graphical Info) Management',
                'description' => 'Manage The Challenges (Graphical Info)',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.challenges.index',
                        'description' => 'View The Challenges (Graphical Info)',
                    ],
                    [
                        'name' => 'admin.challenges.create',
                        'description' => 'Create The Challenges (Graphical Info)',
                    ],
                    [
                        'name' => 'admin.challenges.update',
                        'description' => 'Update The Challenges (Graphical Info)',
                    ],
                    [
                        'name' => 'admin.challenges.archive',
                        'description' => 'Archive/Restore The Challenges (Graphical Info)',
                    ],
                ],
            ],
            [
                'name' => 'Workforce Development (Frame Four) (Graphical Info) Management',
                'description' => 'Manage Workforce Development (Frame Four) (Graphical Info)',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.frame-four.index',
                        'description' => 'View Workforce Development (Graphical Info)',
                    ],
                    [
                        'name' => 'admin.frame-four.create',
                        'description' => 'Create Workforce Development (Graphical Info)',
                    ],
                    [
                        'name' => 'admin.frame-four.update',
                        'description' => 'Update Workforce Development (Graphical Info)',
                    ],
                    [
                        'name' => 'admin.frame-four.archive',
                        'description' => 'Archive/Restore Workforce Development (Graphical Info)',
                    ],
                ],
            ],
            [
                'name' => 'Our Solution Management',
                'description' => 'Manage Our Solution',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.solutions.index',
                        'description' => 'View Our Solution',
                    ],
                    [
                        'name' => 'admin.solutions.create',
                        'description' => 'Create Our Solution',
                    ],
                    [
                        'name' => 'admin.solutions.update',
                        'description' => 'Update Our Solution',
                    ],
                    [
                        'name' => 'admin.solutions.archive',
                        'description' => 'Archive/Restore Our Solution',
                    ],
                ],
            ],
            [
                'name' => 'Our Leadership Management',
                'description' => 'Manage Our Leadership',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.our-leaderships.index',
                        'description' => 'View Our Leadership',
                    ],
                    [
                        'name' => 'admin.our-leaderships.create',
                        'description' => 'Create Our Leadership',
                    ],
                    [
                        'name' => 'admin.our-leaderships.update',
                        'description' => 'Update Our Leadership',
                    ],
                    [
                        'name' => 'admin.our-leaderships.archive',
                        'description' => 'Archive/Restore Our Leadership',
                    ],
                ],
            ],
            [
                'name' => 'Adviser Management',
                'description' => 'Manage Adviser',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.advisers.index',
                        'description' => 'View Adviser',
                    ],
                    [
                        'name' => 'admin.advisers.create',
                        'description' => 'Create Adviser',
                    ],
                    [
                        'name' => 'admin.advisers.update',
                        'description' => 'Update Adviser',
                    ],
                    [
                        'name' => 'admin.advisers.archive',
                        'description' => 'Archive/Restore Adviser',
                    ],
                ],
            ],
            [
                'name' => 'Member Management',
                'description' => 'Manage Member',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.members.index',
                        'description' => 'View Member',
                    ],
                    [
                        'name' => 'admin.members.create',
                        'description' => 'Create Member',
                    ],
                    [
                        'name' => 'admin.members.update',
                        'description' => 'Update Member',
                    ],
                    [
                        'name' => 'admin.members.archive',
                        'description' => 'Archive/Restore Member',
                    ],
                ],
            ],
            [
                'name' => 'Our People Management',
                'description' => 'Manage Our People',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.our-people.index',
                        'description' => 'View Our People',
                    ],
                    [
                        'name' => 'admin.our-people.create',
                        'description' => 'Create Our People',
                    ],
                    [
                        'name' => 'admin.our-people.update',
                        'description' => 'Update Our People',
                    ],
                    [
                        'name' => 'admin.our-people.archive',
                        'description' => 'Archive/Restore Our People',
                    ],
                ],
            ],
            [
                'name' => 'YouthWork FirstFrame (Slider) Management',
                'description' => 'Manage YouthWork FirstFrame (Slider)',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.youthwork-first-frame.index',
                        'description' => 'View YouthWork FirstFrame (Slider)',
                    ],
                    [
                        'name' => 'admin.youthwork-first-frame.create',
                        'description' => 'Create YouthWork FirstFrame (Slider)',
                    ],
                    [
                        'name' => 'admin.youthwork-first-frame.update',
                        'description' => 'Update YouthWork FirstFrame (Slider)',
                    ],
                    [
                        'name' => 'admin.youthwork-first-frame.archive',
                        'description' => 'Archive/Restore YouthWork FirstFrame (Slider)',
                    ],
                ],
            ],
            [
                'name' => 'Courses Management',
                'description' => 'Manage Courses',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.youth-works-courses.index',
                        'description' => 'View Courses',
                    ],
                    [
                        'name' => 'admin.youth-works-courses.create',
                        'description' => 'Create Courses',
                    ],
                    [
                        'name' => 'admin.youth-works-courses.update',
                        'description' => 'Update Courses',
                    ],
                    [
                        'name' => 'admin.youth-works-courses.archive',
                        'description' => 'Archive/Restore Courses',
                    ],
                ],
            ],
            [
                'name' => 'Team Management',
                'description' => 'Manage Team',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.youth-works-teams.index',
                        'description' => 'View Team',
                    ],
                    [
                        'name' => 'admin.youth-works-teams.create',
                        'description' => 'Create Team',
                    ],
                    [
                        'name' => 'admin.youth-works-teams.update',
                        'description' => 'Update Team',
                    ],
                    [
                        'name' => 'admin.youth-works-teams.archive',
                        'description' => 'Archive/Restore Team',
                    ],
                ],
            ],
            [
                'name' => 'YouthWorks Video Management',
                'description' => 'Manage YouthWorks Video',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.youth-works-videos.index',
                        'description' => 'View YouthWorks Video',
                    ],
                    [
                        'name' => 'admin.youth-works-videos.create',
                        'description' => 'Create YouthWorks Video',
                    ],
                    [
                        'name' => 'admin.youth-works-videos.update',
                        'description' => 'Update YouthWorks Video',
                    ],
                    [
                        'name' => 'admin.youth-works-videos.archive',
                        'description' => 'Archive/Restore YouthWorks Video',
                    ],
                ],
            ],
            [
                'name' => 'Project Priority Area Management',
                'description' => 'Manage Project Priority Area',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.project-priority-areas.index',
                        'description' => 'View Project Priority Area',
                    ],
                    [
                        'name' => 'admin.project-priority-areas.create',
                        'description' => 'Create Project Priority Area',
                    ],
                    [
                        'name' => 'admin.project-priority-areas.update',
                        'description' => 'Update Project Priority Area',
                    ],
                    [
                        'name' => 'admin.project-priority-areas.archive',
                        'description' => 'Archive/Restore Project Priority Area',
                    ],
                ],
            ],
            [
                'name' => 'Growth Sectors Management',
                'description' => 'Manage Growth Sectors',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.growth-sectors.index',
                        'description' => 'View Growth Sectors',
                    ],
                    [
                        'name' => 'admin.growth-sectors.create',
                        'description' => 'Create Growth Sectors',
                    ],
                    [
                        'name' => 'admin.growth-sectors.update',
                        'description' => 'Update Growth Sectors',
                    ],
                    [
                        'name' => 'admin.growth-sectors.archive',
                        'description' => 'Archive/Restore Growth Sectors',
                    ],
                ],
            ],
            [
                'name' => 'FAQ Management',
                'description' => 'Manage FAQ',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.faqs.index',
                        'description' => 'View FAQ',
                    ],
                    [
                        'name' => 'admin.faqs.create',
                        'description' => 'Create FAQ',
                    ],
                    [
                        'name' => 'admin.faqs.update',
                        'description' => 'Update FAQ',
                    ],
                    [
                        'name' => 'admin.faqs.archive',
                        'description' => 'Archive/Restore FAQ',
                    ],
                ],
            ],
            [
                'name' => 'Projects Management',
                'description' => 'Manage Projects',
                'icon' => 'fa fa-newspapaer',
                'items' => [
                     [
                        'name' => 'admin.projects.index',
                        'description' => 'View Projects',
                    ],
                    [
                        'name' => 'admin.projects.create',
                        'description' => 'Create Projects',
                    ],
                    [
                        'name' => 'admin.projects.update',
                        'description' => 'Update Projects',
                    ],
                    [
                        'name' => 'admin.projects.archive',
                        'description' => 'Archive/Restore Projects',
                    ],
                ],
            ],
        ];

    	foreach ($categories as $category) {
            $permissions = $category['items'];
            unset($category['items']);

            $item = PermissionCategory::where('name', $category['name'])->first();

            if (!$item) {
                $this->command->info('Adding permission category ' . $category['name'] . '...');
                $item = PermissionCategory::create($category);
            } else {
                $this->command->warn('Updating permission category ' . $category['name'] . '...');
                $item->update($category);
            }


            foreach ($permissions as $permission) {
                $permissionItem = Permission::where('name', $permission['name'])->first();
                
                if (!$permissionItem) {
                    $this->command->info('Adding permission ' . $permission['name'] . '...');
                    $item->permissions()->create($permission);
                } else {
                    $this->command->warn('Updating permission ' . $permission['name'] . '...');
                    unset($permission['name']);
                    $permissionItem->update($permission);
                }
            }
    	}
    }
}
