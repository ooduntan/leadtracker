<?php

use App\Role;
use App\Category;
use App\Visitor;
use App\User;
use App\Website;
use Illuminate\Database\Seeder;

class B2BSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Role::create([
            'name' => 'NORMAL',
        ]);

        Role::create([
            'name' => 'ADMIN',
        ]);

        User::create([
            'role_id' => 1,
            'first_name' => 'Ademola',
            'last_name' => 'Raimi',
            'email' => 'ademolaraimi.nig@gmail.com',
            'confirmed' => 1,
            'password' => bcrypt('secret')
        ]);

        User::create([
            'role_id' => 1,
            'first_name' => 'Stephen',
            'last_name' => 'Oluwatobiloba',
            'email' => 'stephen.tobi@gmail.com',
            'confirmed' => 1,
            'password' => bcrypt('secret')
        ]);

        Category::create([
            'name' => 'Customer',
            'description' => 'Potential customer for your business',
        ]);

        Category::create([
            'name' => 'Competitor',
            'description' => 'Competitors, do the same business you do',
        ]);

        Category::create([
            'name' => 'Lead',
            'description' => 'I dont know yet',
        ]);

        Website::create([
            'domain' => 'http://www.andela.com',
            'user_id' => 1,
            'status' => 1,
        ]);

        Website::create([
            'domain' => 'http://www.demola.com',
            'user_id' => 1,
            'status' => 1,
        ]);

        Website::create([
            'domain' => 'http://www.stephen.com',
            'user_id' => 2,
            'status' => 1,
        ]);

        Visitor::create([
            'website_id' => 1,
            'ip_address' => '62.154.197.160 - 62.154.197.167',
            'country' => "DE",
            'company' => "HEINEN-LOEWENSTEIN-GMBH-BAD-EMS-NET",
            'description' => "Heinen & Loewenstein GmbH",
            'links' => json_encode(["http://rest.db.ripe.net/ripe/person/SH1308-RIPE", "http://rest.db.ripe.net/ripe/person/SH1308-RIPE", "http://rest.db.ripe.net/ripe/mntner/DTAG-NIC"]),
            'source' => "ripe",
            'first_seen' => '2003-09-03T13:30:07Z',
            'last_seen' => '2003-09-03T13:30:07Z',
        ]);

        Visitor::create([
            'website_id' => 1,
            'ip_address' => '50.154.197.160 - 50.154.197.167',
            'country' => "NG",
            'company' => "HEINEN-LOEWENSTEIN-GMBH-BAD-EMS-NET",
            'description' => "Heinen & Loewenstein GmbH",
            'links' => json_encode(["http://rest.db.ripe.net/ripe/person/SH1308-RIPE", "http://rest.db.ripe.net/ripe/person/SH1308-RIPE", "http://rest.db.ripe.net/ripe/mntner/DTAG-NIC"]),
            'source' => "ripe",
            'first_seen' => '2003-09-03T13:30:07Z',
            'last_seen' => '2003-09-03T13:30:07Z',
        ]);

        Visitor::create([
            'website_id' => 2,
            'ip_address' => '62.154.197.160 - 62.154.197.167',
            'country' => "US",
            'company' => "HEINEN-LOEWENSTEIN-GMBH-BAD-EMS-NET",
            'description' => "Heinen & Loewenstein GmbH",
            'links' => json_encode(["http://rest.db.ripe.net/ripe/person/SH1308-RIPE", "http://rest.db.ripe.net/ripe/person/SH1308-RIPE", "http://rest.db.ripe.net/ripe/mntner/DTAG-NIC"]),
            'source' => "ripe",
            'first_seen' => '2003-09-03T13:30:07Z',
            'last_seen' => '2003-09-03T13:30:07Z',
        ]);
    }
}
