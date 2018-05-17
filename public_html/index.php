<?php
date_default_timezone_set('America/Chicago');

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// turn off debug mode for live site
$app['debug'] = (gethostname() == 'web01') ? false : true;

// register twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

$app['conference_year'] = "2018";

$published_menu = array(
    'Home' => '/',
    'Tickets' => '/tickets/',
//    'Schedule' => '/schedule/',
//    'Speakers' => '/speakers/',
    'Venue/Hotel' => '/venue/',
    'Sponsors' => '/sponsors/',
    'What to Expect' => '/expect/',
    'Call for Papers' => 'https://cfp.madisonphpconference.com',
    'Code of Conduct' => '/conduct/',
    'Contact' => 'https://contact.madisonphpconference.com'
);

$app['nav'] = $published_menu;

$sponsors = array(
    'partner' => array(
        array(
            'name' => '',
            'href' => '',
            'img'  => '',
            'thumbnail' => '',
            'twitter' => '',
        ),
    ),
    'gold' => array(
        array(
            'name' => '',
            'href' => '',
            'img'  => '',
            'thumbnail' => '',
            'twitter' => '',
        ),
    ),
    'silver' => array(
        array(
            'name' => 'Madison College',
            'href' => 'http://it.madisoncollege.edu',
            'img'  => '/assets/images/sponsors/madisoncollege.jpg',
            'thumbnail' => '/assets/images/sponsors/madisoncollege_thumb.jpg',
            'twitter' => 'MadisonIT',
        ),
        array(
            'name' => 'Snap Programming',
            'href' => 'http://snapprogramming.com/',
            'img'  => '/assets/images/sponsors/snapprogramming.png',
            'thumbnail' => '/assets/images/sponsors/snapprogramming_thumb.png',
            'twitter' => 'SnapProgramming',
        ),
    ),
    'bronze' => array(
        array(
            'name' => '',
            'href' => '',
            'img'  => '',
            'thumbnail' => '',
            'twitter' => '',
        ),
    ),
    'scholarship' => array(
        array(
            'name' => '',
            'href' => '',
            'img'  => '',
            'thumbnail' => '',
            'twitter' => '',
        ),
    ),
    'community' => array(
        array(
            'name' => '',
            'href' => '',
            'img'  => '',
            'thumbnail' => '',
            'twitter' => '',
        ),
    ),
);

$app['sponsors'] = $sponsors;

$schedule_set = 'no';
$rooms_set= 'no';
$speakers_set= 'no';

$app['schedule_set'] = $schedule_set;
$app['rooms_set'] = $rooms_set;
$app['speakers_set'] = $speakers_set;

$talks = array(
    'T01' => array(
        'speaker' => array (
            array (
                'name' => '',
                'img' => '',
                'bio' => '',
                'twitter' => '',
            ),
        ),
        'title' => '',
        'tagline' => '',
        'talk_description' => '',
        'talk_type' => '',
        'display_speaker' => '',
    ),
);

$app['talks'] = $talks;

// use layout templates
$app->before(function () use ($app) {
    $app['twig']->addGlobal('layout', null);
    $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig.html'));
});

// route for home page
$app->get('/', function() use($app) {
    return $app['twig']->render('pages/home.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Home',
        'conference_year' => $app['conference_year'],
    ));
});

// route for schedule
$app->get('/schedule/', function() use($app) {
    return $app['twig']->render('pages/schedule.html', array(
        'nav' => $app['nav'],
        'talks' => $app['talks'],
        'sponsors' => $app['sponsors'],
        'active' => 'Schedule',
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));});

// route for speakers
$app->get('/speakers/', function() use($app) {
    return $app['twig']->render('pages/speakers.html', array(
        'nav' => $app['nav'],
        'talks' => $app['talks'],
        'sponsors' => $app['sponsors'],
        'active' => 'Speakers',
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));});

// route for venue
$app->get('/venue/', function() use($app) {
    return $app['twig']->render('pages/venue.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Venue',
        'conference_year' => $app['conference_year'],
    ));
});

// route for hotel
$app->get('/hotel/', function() use($app) {
    return $app['twig']->render('pages/hotel.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Hotel',
        'conference_year' => $app['conference_year'],
    ));
});

// route for sponsors
$app->get('/sponsors/', function() use($app) {
    return $app['twig']->render('pages/sponsors.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Sponsors',
        'conference_year' => $app['conference_year'],
    ));
});

// route for expect
$app->get('/expect/', function() use($app) {
    return $app['twig']->render('pages/expect.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'What to Expect',
        'conference_year' => $app['conference_year'],
    ));
});

// route for organizers
$app->get('/organizers/', function() use($app) {
    return $app['twig']->render('pages/organizers.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Organizers',
        'conference_year' => $app['conference_year'],
    ));
});

// route for tickets
$app->get('/tickets/', function() use($app) {
    return $app['twig']->render('pages/tickets.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Tickets',
        'conference_year' => $app['conference_year'],
    ));
});

// route for conduct
$app->get('/conduct/', function() use($app) {
    return $app['twig']->render('pages/conduct.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Code of Conduct',
        'conference_year' => $app['conference_year'],
    ));
});

// route for the conference map
$app->get('/conference_map/', function() use($app) {
    return $app['twig']->render('pages/conference_map.html', array(
        'nav' => $app['nav'],
        'sponsors' => $app['sponsors'],
        'active' => 'Conference Map',
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});

// routes for schedule
$app->get('/talks/T01/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T01'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T02/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T02'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T03/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T03'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T04/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T04'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T05/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T05'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T06/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T06'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T07/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T07'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T08/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T08'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T09/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T09'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T10/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T10'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T11/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T11'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T12/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T12'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T13/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T13'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T14/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T14'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T15/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T15'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T16/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T16'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T17/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T17'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T18/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T18'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T19/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T19'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T20/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T20'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T21/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T21'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T22/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T22'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});
$app->get('/talks/T23/', function() use($app) {
    return $app['twig']->render('pages/talks.html', array(
        'nav' => $app['nav'],
        'active' => 'Schedule',
        'sponsors' => $app['sponsors'],
        'talk' => $app['talks']['T23'],
        'conference_year' => $app['conference_year'],
        'schedule_set' => $app['schedule_set'],
        'rooms_set' => $app['rooms_set'],
        'speakers_set' => $app['speakers_set'],
    ));
});





$app->run();
