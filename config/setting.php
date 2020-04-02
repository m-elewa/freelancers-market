<?php

return [

    'error_pages_layout' => 'errors::illustrated-layout',

    'seed_randum_amount' => env('SEED_RANDUM_AMOUNT', true),

    'migrate_test_database' => env('MIGRATE_TEST_DATABASE', true),

    'freelance_website_name' => env('FREELANCE_WEBSITE_NAME', 'Freelance Website'),

    'freelance_website_domain' => env('FREELANCE_WEBSITE_DOMAIN', 'example.com/'),

    'home_page_introduction_title' => 'NEVER pay to work!',

    'home_page_introduction_details' => '
        <p class="lead"><span class="font-weight-bold">Apply for unlimited jobs on '.env("FREELANCE_WEBSITE_NAME").' for free.</span> We will work like a broker 
        between the clients and the freelancers but the actual work and pay will be done on '.env("FREELANCE_WEBSITE_NAME").'. <u>How it works?</u> clients 
        can link their jobs here to let freelancers apply for free on their jobs. Then the client can invite the suited freelancer(s) to apply on his job on '
        .env("FREELANCE_WEBSITE_NAME").'.</p>
    ',
];
