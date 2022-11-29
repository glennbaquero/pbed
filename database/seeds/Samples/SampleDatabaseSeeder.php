<?php

use Illuminate\Database\Seeder;

class SampleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(AdminsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        // $this->call(PagesTableSeeder::class);

        // $this->call(SampleItemsTableSeeder::class);
        // $this->call(SampleItemRelationshipsTableSeeder::class);
        // $this->call(SampleArticlesTableSeeder::class);
        $this->call(SampleAdminsTableSeeder::class);
        $this->call(SampleUsersTableSeeder::class);

        //CIS
        $this->call(ConfidentialityCategoriesTableSeeder::class);

        $this->call(ClassificationAccessesTableSeeder::class);
        $this->call(UserClassificationsTableSeeder::class);

        $this->call(ContactCategoriesTableSeeder::class);
        $this->call(ContactCategoryFieldsTableSeeder::class);

        $this->call(ContactInformationTableSeeder::class);
        $this->call(ContactInformationFieldsTableSeeder::class);
        $this->call(InformationAccessesTableSeeder::class);

        //CMS
        $this->call(NewsTableSeeder::class);
        $this->call(BlogsTableSeeder::class);
        $this->call(CareersTableSeeder::class);
        $this->call(AdvocaciesTableSeeder::class);
        $this->call(FirstFramesTableSeeder::class);
        $this->call(LatestStudiesTableSeeder::class);
        $this->call(PageAndPageItemSeeder::class);
        $this->call(ProcurementTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(OurLeadershipsTableSeeder::class);
        $this->call(AdvisersTableSeeder::class);    
        $this->call(MembersTableSeeder::class);    
        $this->call(OurPeopleTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(MilestonesTableSeeder::class);
        $this->call(ProjectMembersTableSeeder::class);
    }
}
