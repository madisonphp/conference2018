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

$app['conference_year'] = "2017";

$published_menu = array(
    'Home' => '/',
//    'Tickets' => '/tickets/',
//    'Schedule' => '/schedule/',
//    'Speakers' => '/speakers/',
//    'Venue/Hotel' => '/venue/',
//    'Sponsors' => '/sponsors/',
    'What to Expect' => '/expect/',
//    'Call for Papers' => 'http://cfp.madisonphpconference.com',
    'Code of Conduct' => '/conduct/',
    'Contact' => 'http://contact.madisonphpconference.com'
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
        /**array(
            'name' => 'Madison College',
            'href' => 'http://it.madisoncollege.edu',
            'img'  => '/assets/images/sponsors/madisoncollege.jpg',
            'thumbnail' => '/assets/images/sponsors/madisoncollege_thumb.jpg',
            'twitter' => 'MadisonIT',
        ),
        array(
            'name' => 'Web Courseworks',
            'href' => 'http://www.webcourseworks.com',
            'img'  => '/assets/images/sponsors/webcourseworks.png',
            'thumbnail' => '/assets/images/sponsors/webcourseworks_thumb.png',
            'twitter' => 'WebCourseworks',
        ),**/
    ),
    'bronze' => array(
        /**array(
            'name' => 'Snap Programming',
            'href' => 'http://snapprogramming.com/',
            'img'  => '/assets/images/sponsors/snapprogramming.png',
            'thumbnail' => '/assets/images/sponsors/snapprogramming_thumb.png',
            'twitter' => 'SnapProgramming',
        ),
        array(
            'name' => 'Boberdoo',
            'href' => 'https://www.boberdoo.com/',
            'img'  => '/assets/images/sponsors/boberdoo.png',
            'thumbnail' => '/assets/images/sponsors/boberdoo_thumb.png',
            'twitter' => 'boberdoo',
        ),
        array(
            'name' => 'Robert Half',
            'href' => 'https://www.roberthalf.com/madison/technology-it',
            'img'  => '/assets/images/sponsors/roberthalf.jpg',
            'thumbnail' => '/assets/images/sponsors/roberthalf_thumb.jpg',
            'twitter' => 'RobertHalfTech',
        ),
        array(
            'name' => 'Earthling Interactive',
            'href' => 'https://earthlinginteractive.com/',
            'img'  => '/assets/images/sponsors/earthling.png',
            'thumbnail' => '/assets/images/sponsors/earthling_thumb.png',
            'twitter' => 'WeAreEarthling',
        ),
        array(
            'name' => 'SiteGround',
            'href' => 'http://www.siteground.com',
            'img'  => '/assets/images/sponsors/siteground.png',
            'thumbnail' => '/assets/images/sponsors/siteground_thumb.png',
            'twitter' => 'SiteGround',
        ),**/
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
        /**array(
            'name' => 'php[architect]',
            'href' => 'https://www.phparch.com/',
            'img'  => '/assets/images/sponsors/phparch.png',
            'thumbnail' => '/assets/images/sponsors/phparch_thumb.png',
            'twitter' => 'phparch',
        ),
        array(
            'name' => 'MySQL',
            'href' => 'http://www.mysql.com/',
            'img'  => '/assets/images/sponsors/MySQL.png',
            'thumbnail' => '/assets/images/sponsors/MySQL_thumb.png',
            'twitter' => 'mysql',
        ),**/
    ),
);

$app['sponsors'] = $sponsors;

$schedule_set = 'yes';
$rooms_set= 'yes';
$speakers_set= 'yes';

$app['schedule_set'] = $schedule_set;
$app['rooms_set'] = $rooms_set;
$app['speakers_set'] = $speakers_set;

$talks = array(
    /**'T01' => array(
        'speaker' => array (
            array (
                'name' => 'Rodney Urquhart',
                'img' => 'rodney_urquhart.png',
                'bio' => 'Rodney Urquhart is a senior software engineer at Slack, one of the hottest startups in Silicon Valley. His story demonstrates what perseverance, determination, and a little bit of luck can turn into. <br><br>Being a high school dropout and having no college degree, Rodney had his fair share of companies casting doubt on his ability. But his willingness to learn and work well with others was what got him to create an impressive company portfolio including Comcast, Microsoft, and ThoughtWorks.<br><br>He didn’t just want to survive, he learned how to thrive. Rodney is currently one of the leaders for the test infrastructure team at Slack. He is also part of a program called /dev/color, a non-profit organization that aims to maximize the impact of Black software engineers in the tech space.',
                'twitter' => 'RodneyU215',
            ),
        ),
        'title' => 'Engineering a Successful Career Through Failure!',
        'tagline' => '',
        'talk_description' => 'A lot can be said about my journey in tech thus far! To most people, my background and educational history leave much to be desired. I started from very humble beginnings. In an unlikely story, I went from working at a glass factory to becoming a Software Engineer.<br><br>In this session, I’m going to share a little bit about my life and what I’ve learned over the years. I’m going to talk about where I started, some of my biggest failures, as well as how I used a lot of failure and soft skills to catapult me into the life I’m proud to be living right now. I’m living my dreams! I am successful in every way that matters to me. My family is happy, I’m building wealth, I’m still learning through failure, and most importantly, I’m loving life!',
        'talk_type' => 'keynote',
        'display_speaker' => 'yes',
    ),
    'T02' => array(
        'speaker' => array (
            array (
                'name' => 'Michelangelo van Dam',
                'img' => 'michelangelo_van_dam.jpg',
                'bio' => '<a href="http://www.dragonbe.com">Michelangelo</a> is a veteran PHP consultant working at <a href="https://www.in2it.be">in2it</a>, community leader for <a href="https://www.phpbenelux.eu">PHPBenelux</a>, coach and mentor for kids at <a href="https://www.coderdojo.org">CoderDojo</a> and a global conference speaker. Get him a coffee and he will tell you all about testing, continuous deployments, cloud or community work.',
                'twitter' => 'DragonBe',
            ),
        ),
        'title' => 'Thank You PHP Community, I Owe You so Much',
        'tagline' => '',
        'talk_description' => 'In my daily work, I bring all my experiences and knowledge to the table, and I\'m making a good living out of it. But this wasn\'t always the case. I struggled through life when I was younger, and it wasn\'t until 2007 that I got in touch with the PHP community at a conference. That moment changed everything in my life. This talk is about how amazing and life changing the PHP community is and why it\'s important for people to become part of it. I know you want to change the world, and now it\'s within your reach. Your actions can change the life of many for the best, and we\'d like you to join us.',
        'talk_type' => 'keynote',
        'display_speaker' => 'yes',
    ),
    'T03' => array(
        'speaker' => array (
            array (
                'name' => 'Jordan Kasper',
                'img' => 'jordan_kasper.jpg',
                'bio' => 'Shortly after it arrived at his home in 1993, Jordan began disassembling his first computer - his mother was not happy. She breathed more easily when he moved from hardware into programming. Jordan\'s experience includes development and instruction at startups, agencies, Fortune 100 companies, and universities, as well as numerous open source projects. His programming experience includes JavaScript (and Node.js), PHP, Java, Natural, Perl, and more. He speaks regularly at (and helps organize) local user groups and conferences big and small. Jordan\'s primary mission for over 10 years has been to evangelize technology of all sorts and share what he has learned to help others grow. In his down time, he enjoys puzzles of all sorts and board games!',
                'twitter' => 'jakerella',
            ),
        ),
        'title' => 'Getting More Out Of Git',
        'tagline' => '',
        'talk_description' => 'You\'ve taken the plunge and your organization is fully immersed in Git... Great! But now the hard stuff starts creeping in. Your team is growing, becoming more diverse and distributed. It\'s time to level up. This tutorial will walk attendees through a number of real world scenarios and how they might be handled using Git on the command line. This is not an introductory workshop, so come prepared with some basic understanding of version control with Git including staging (adding), committing, pushing, and pulling changes. We\'ll cover many topics including branching strategies, amending commits, resetting, using the stash, cherry-picking, and merging versus rebasing. Attendees will come out of this session with a better grasp of how to use more advanced features of Git and some new strategies to take back to the office.',
        'talk_type' => 'tutorial',
        'display_speaker' => 'yes',
    ),
    'T04' => array(
        'speaker' => array (
            array (
                'name' => 'Ken Marks',
                'img' => 'ken_marks.jpg',
                'bio' => 'Ken is an IT Programming Instructor at Madison Area Technical College. He teaches intro and advanced programming in JavaScript, Java, and PHP. In a previous life Ken spent a big chunk of his career developing medical device software in C and C++. When Ken is not teaching he enjoys spending time with his family, and roasting his own coffee beans.',
                'twitter' => 'FlibertiGiblets',
            ),
        ),
        'title' => 'Hack Your Home With a Raspberry Pi',
        'tagline' => '',
        'talk_description' => 'Do you ever wonder what\'s happening at your home when you\'re not there? Wouldn\'t it be fun to get a text message when your dryer is done? Using a LAMP stack on a device smaller than a credit card, you will learn to connect sensors to create web-enabled devices to monitor the temperature around your house and more! In this tutorial, you will do all of this on a Raspberry Pi Zero that you get to keep!<br><br><div class="highlight-box" style="text-align: center;"><h3>Because of the hardware needed (which you get to keep), there is an additional $40 fee to attend this tutorial which must be purchased after you buy your conference ticket.</h3><br><span class="plo-button btn-red">Sold Out</span><br><br></div><br>',
        'talk_type' => 'tutorial',
        'display_speaker' => 'yes',
    ),
    'T18' => array(
        'speaker' => array (
            array (
                'name' => 'Andrea Skeries',
                'img' => 'andrea_skeries.jpg',
                'bio' => 'My mission is to bring awareness to designers, developers, and content writers that the work they do has a direct impact on people\'s lives. For more than a decade I\'ve worked with healthcare, hospitality, restaurants, non-profits, educational, and governmental organizations to provide accessible user experiences for their site visitors. As a Certified Professional in Accessibility Core Competencies (CPACC) through the IAAP, I educate the community with interactive training and building empathy in workshops and meetups.',
                'twitter' => 'Artistic_Abode',
            ),
        ),
        'title' => 'Guide to UX Testing with Assistive Technology',
        'tagline' => '',
        'talk_description' => 'An accessible website opens the door for millions more people to engage in your site content. In many cases, it is also a legal requirement. Learn testing techniques to check your website for ADA, Section 508 and WCAG 2.0 compliance. During this workshop you will hone your manual testing skills as well as learn about automated testing tools.',
        'talk_type' => 'tutorial',
        'display_speaker' => 'yes',
    ),
    'T05' => array(
        'speaker' => array (
            array (
                'name' => 'Chris Tankersley',
                'img' => 'chris_tankersley.jpg',
                'bio' => 'Chris Tankersley is a husband, father, author, speaker, PHP developer, podcast host, and probably lots of other things he\'s forgetting to mention. He works for InQuest, a network security company out of Washington, DC, but lives in Northwest Ohio where it is much colder sometimes. Chris has worked with many different frameworks and languages throughout his twelve years of programming, but spends most of his day working in PHP, with a sprinkling of Python thrown in for good measure. He is the author of "Docker for Developers"',
                'twitter' => 'dragonmantank',
            ),
        ),
        'title' => 'Docker for PHP Developers',
        'tagline' => '',
        'talk_description' => 'Docker is quickly becoming an invaluable development and deployment tool for many organizations. Come and spend the day learning about what Docker is, how to use it, how to integrate it into your workflow, and build an environment that works for you and the rest of your team. This hands-on tutorial will give you the kick-start needed to start using Docker effectively.',
        'talk_type' => 'tutorial',
        'display_speaker' => 'yes',
    ),
    'T06' => array(
        'speaker' => array (
            array (
                'name' => 'Christian Varela',
                'img' => 'christian_varela.jpg',
                'bio' => 'Husband, Father of 3 girls. He is PHP programmer with 13 years of experience. He started working with PHP to create web applications. He\'s originally from Mexico and he has lived in Miami for 8 years. He created his own company <a href="http://www.conquerorsoft.com/">Conqueror Soft</a>. Currently he works for both his company and CVS Health. He is the lead PHP programmer at CVS. He likes to play piano and guitar.',
                'twitter' => 'gabriel0702',
            ),
        ),
        'title' => 'Create an API-centric System for Web and Mobile',
        'tagline' => '',
        'talk_description' => 'In this tutorial, we start by defining an API with Apigility as our main engine, we will define all the details to make sure we set up our API so it can be consumed by our web application and our mobile application. We continue by creating a web application that will consume the API resources and how to define the flow from data consumption to views using **Zend Framework**. Then we will define a simple mobile app, which will consume the services from our API. For this we will use Sencha Touch. We will learn about the details to promote our App to the App store and Google play.',
        'talk_type' => 'tutorial',
        'display_speaker' => 'yes',
    ),
    'T07' => array(
        'speaker' => array (
            array (
                'name' => 'Liam Wiltshire',
                'img' => 'liam_wiltshire.jpg',
                'bio' => 'Liam is a UK based Senior PHP Developer &amp; Business Manager at Tebex, creators of <a href="http://www.buycraft.net">Buycraft.net</a>, the first e-commerce platform for Minecraft. In his nine years as a dev, he\'s tackled projects large and small, from multi-million pound eCommerce sites to the plumber down the road looking for \'mates\' rates. These days Liam focuses on providing gCommerce platforms for multiplayer sandbox games, and in his spare time is trying to learn the secret to actually having some spare time.',
                'twitter' => 'l_wiltshire',
            ),
        ),
        'title' => 'Linux SysAdmin 101',
        'tagline' => '',
        'talk_description' => 'The vast majority of PHP developers work with a Linux environment - be that a staging box, AWS or more traditional hosting, most servers we work with are Linux-based. However, not all of us have an \'in depth\' knowledge of the platform. This tutorial gives a detailed, hands on introduction to Linux SysAdmin, so that any PHP developer can SSH into a box and debug an issue, without having to go to a senior dev, or having to phone up their hosting company and sit in a queue forever. Working with pre-created Linux virtual machines, delegates will have hands-on instruction on the following topics:<ul><li> Introduction to Linux distros (focused on Ubuntu (deb) and CentOS (rpm))</li><li> The Linux CLI (Connecting to Linux, using the CLI, common CLI tools)</li><li> Setting up a standard LAMP (Apache) stack and LNMP (Nginx) stack, including SSL and vhosts</li><li> Server troubleshooting</li><li> Server monitoring using built in tools</li></ul>Having \'in house\' developers with Linux skills is a massive benefit to any organization, so by the end of this tutorial delegates will not only be able to take on small server tasks, but also have the grounding and skills to learn more and develop their SysAdmin knowledge further.',
        'talk_type' => 'tutorial',
        'display_speaker' => 'yes',
    ),
    'T08' => array(
        'speaker' => array (
            array (
                'name' => 'Edward Barnard',
                'img' => 'edward_barnard.jpg',
                'bio' => 'Ed Barnard had a front-row seat when the Morris Worm took down the Internet, November 1988. He was teaching CRAY-1 supercomputer operating system internals to analysts as they were being directly hit by the Worm. It was a busy week! Ed continues to indulge his interests in computer security and teaching software concepts to others.',
                'twitter' => 'ewbarnard',
            ),
        ),
        'title' => 'PHP Prepared Statements and MySQL Table Design',
        'tagline' => '',
        'talk_description' => 'When using a PHP framework, standard practice is to use an Object-Relational Model (ORM) for database access. However, with high-volume logging and statistics-gathering, it pays to go "old school" with PHP prepared statements. Meanwhile, when MySQL tables quickly grow by millions of rows, table storage space becomes an issue. Our table design must focus on keeping these tables more compact and efficient. Here too, prepared statements simplify both coding and table design. We\'ll be using CakePHP 3\'s excellent support for PHP prepared statements, but all concepts are native to PHP and apply to any project striking this use case.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T09' => array(
        'speaker' => array (
            array (
                'name' => 'Derek Binkley',
                'img' => 'derek_binkley.jpg',
                'bio' => 'Derek is the Technical Lead at the National Conference of Bar Examiners, the creator of licensing exams for attorneys. He actively mentors other developers, specializes in Java, PHP, JavaScript, MySQL and Oracle and advocates for developer testing and adoption of agile methods. When not in front of a computer he enjoys spending time with family, traveling and drinking a local craft beer.',
                'twitter' => 'DerekB_WI',
            ),
        ),
        'title' => 'What Raising 3 Kids Taught Me About Working with Users',
        'tagline' => '',
        'talk_description' => 'No matter the size of your team most developers work with users or stakeholders to develop project requirements. Making your way through competing requests to get to a good design takes a lot of time and skill. In this talk Derek will use what he has learned as a parent and humorously apply it to product design and requirement gathering. You will learn about effective methods for getting agreement on product features and interface design. You will learn  ways of discovering what stakeholders really need to ensure delivery of a great product. These are valuable skills that can help you create better applications, become more valuable to your team, and advance your career. You might even pick up a parenting tip or two.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T10' => array(
        'speaker' => array (
            array (
                'name' => 'Philippe Gamache',
                'img' => 'philippe_gamache.jpg',
                'bio' => 'Philippe Gamache contributes to PHP since 1999: promotion, participation at local user groups, organizing conferences, speaking at conferences and writing technical articles. He works especially with Symfony, specializing in security, code quality, and performance. Co-author of a PHP security book called "Sécurité PHP 5 et MySQL". He was a member of the executive board of Montreal\'s OWASP (Open Web Application Security Project) group for several years. Now a big part of his work is to help the PHP community to adopt new tools like kuzzle to add a real-time engine, subscription and notification mechanisms, geolocation/geofencing, advanced search features and more protocols to their applications.',
                'twitter' => 'philoupedia',
            ),
        ),
        'title' => 'Browser Serving Your Web Application Security',
        'tagline' => '',
        'talk_description' => 'One important concept in web application security is defense in depth. You protect your server, your network, your database and your application, but what about the user browser? Can it be done? Yes! Several new technologies and protocols to assist security has been added to the browsers. Several should be added, activated and configure from your web server or web page. In this presentation we will explore these technologies and learn how to use them. You\'ll learn about the Robots meta tags (for crawlers indexing), Browsing Compatibility, XSS and Clickjaking Protection, SSL/TLS Control, and Content Security Policy.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T16' => array(
        'speaker' => array (
            array (
                'name' => 'Daniel Greig',
                'img' => 'daniel-greig.jpg',
                'bio' => 'Daniel Greig is a team and technical lead at Earthling Interactive. He has worked in a variety of languages and systems over the last 15 years.',
                'twitter' => '',
            ),
        ),
        'title' => 'Creating a Local Dev Environment with Vagrant and Puppet',
        'tagline' => '',
        'talk_description' => 'Local environments suffer from multiple problems. Different versions of PHP, base OS differences, and configuration differences. Those differences could just be between you and the production server, or even between you and your co-workers. These differences can cause frustration and panic when you push code to production and find out that date() works differently between the Windows version of PHP and the Linux version. What if I were to tell you that we could avoid all those hassles? By the end of this talk, you should have a good understanding of why we would want to do this and how you would get started on this with your own projects.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T11' => array(
        'speaker' => array (
            array (
                'name' => 'Julka Grodel',
                'img' => 'julka_grodel.jpg',
                'bio' => 'Julka Grodel is a Principal Software Engineer at Framebridge, a DC startup disrupting the custom framing market. She is passionate about writing easily maintainable and extendable code and has worked professionally in web development for over a decade. When not working on code empowering Framebridge customers to frame everything they love, she spends her time volunteering on literacy projects with the Junior League, in a pilates studio, or doting over her blind cat Batman and his BFF Robin.',
                'twitter' => 'jgrodel',
            ),
        ),
        'title' => 'Will You Help Me End Pixelated Images on the Internet?',
        'tagline' => '',
        'talk_description' => 'Have you heard about how Scalable Vector Graphics can look great at any resolution and can take up less space than other images? Have you ever taken a look at the code behind them? Let me introduce you to the XML format that is SVG, styling them and some transformations so you can begin putting them to work on your site. This talk assumes some knowledge of HTML or XML, and a bit of CSS.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T12' => array(
        'speaker' => array (
            array (
                'name' => 'Nara Kasbergen',
                'img' => 'nara_kasbergen.jpg',
                'bio' => 'Nara Kasbergen is a full-stack developer in NPR (National Public Radio)\'s Digital Media group, where she\'s worked on a variety of projects, most notably the third-party developer platform for NPR One. She recently joined the tech conference speaking circuit because of her interest in Developer Experience (DX), community-building, the intersection of humans and code, and her volunteer work for Open Sourcing Mental Illness, a non-profit organization raising awareness about mental health in the tech industry. Though she has no noticeable accent, she hails from The Netherlands and lived in Munich, Houston, Pittsburgh, Tokyo, and New York City prior to settling down in Washington, DC. In her spare time, she satisfies her foodie habits by trying out all of the best restaurants in the city, collects board games, and watches too much Netflix.',
                'twitter' => 'xiehan',
            ),
        ),
        'title' => 'Empathy As A Service: Supporting Mental Health in the Tech Workplace',
        'tagline' => '',
        'talk_description' => 'At any given time, 1 in 5 Americans are living with a mental illness, such as depression, bipolar disorder, generalized anxiety disorder, substance use disorder, burnout, or ADHD. Statistically, all of us working for an organization with 5 or more employees have at least one colleague who is affected. At the same time, the tech industry is often characterized by high stress, long hours, workplace pressure to be available by phone and e-mail after-hours or sometimes even while on vacation, social pressure to constantly network and attend conferences and make a name for yourself, and the precarious balance between trying to do good by contributing to open-source and maintaining some semblance of free time that doesn\'t involve coding. Given how this demanding environment increasingly blurs the line between our professional and personal lives, how can we ensure that the most vulnerable among us aren\'t being left behind? As a community, the single most damaging thing we can do is continue to treat mental health as a personal shortcoming that can\'t be talked about openly. We shouldn\'t think of it as "somebody else\'s problem"; the 4 in 5 of us who don\'t currently have mental health disorders must do our part to help end the stigma. This talk will begin with an overview of key statistics about mental illness, followed by the efforts of the non-profit organization <a href="https://osmihelp.org">Open Sourcing Mental Illness</a> to gather more data about mental health in the tech industry, the ALGEE action plan taught by the <a href="https://www.mentalhealthfirstaid.org">Mental Health First Aid</a> training course, and finally conclude with ideas and strategies for making our tech workplaces more accommodating and inclusive.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T13' => array(
        'speaker' => array (
            array (
                'name' => 'Vesna Kovach',
                'img' => 'vesna_kovach.jpg',
                'bio' => 'Vesna Kovach is part of the small, passionate, agile development team at OfficeSupply.com near Madison, Wisconsin. She runs DevDivas.com, a site that celebrates the history of women in technology, and tweets at @dev_divas.',
                'twitter' => 'vesna_v_k',
            ),
        ),
        'title' => 'Dev Divas: History\'s Heroines of Computing',
        'tagline' => '',
        'talk_description' => 'Call yourself a "software engineer"? Thank MIT supercoder Margaret Hamilton, who invented the term that once drew chuckles. Ada Lovelace in the 19th century was the first to recognize that programmable computing machines could model any system, and thus transform our world. Yet this woman, who drew on her mastery of calculus to write the first program for a computer, is often dismissed as a delusional math klutz. Learn how the women highlighted in the 2016 blockbuster "Hidden Figures" were even more remarkable than the movie showed, and how they and their colleagues rebuilt our world. Through most of the 20th century, progress in science and technology was powered largely by thousands upon thousands of women who both created massively complex algorithms and executed them by hand. Over decades, machines took on the second task superbly. But the first task proved impossible to offload to machines. Today we call it "computer programming." The contributions made by these women cannot be understated -- except that in fact, it has been. Meet the mostly unsung women who shaped the high-tech world we live in -- the women who brought us the first computer language, the compiler, the flowchart, and so much more. Celebrate their stories, and learn about their struggles. Find out what the landscape looks like today for women in tech, and learn how you can contribute to a brighter future for all.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T22' => array(
        'speaker' => array (
            array (
                'name' => 'Oscar Merida',
                'img' => 'oscar-merida.jpg',
                'bio' => 'Oscar still remembers downloading an early version of the Apache HTTP server at the end of 1995, and promptly asking "Ok, what\'s this good for?" He started learning PHP in 2000 and hasn\'t stopped since. He\'s worked with Drupal, WordPress, Zend Framework, Silex, and bespoke PHP, to name a few. Currently, he\'s the Editor-in-chief at php[architect], a monthly magazine for PHP programmers.',
                'twitter' => 'omerida',
            ),
        ),
        'title' => 'PHP OOP: An Object-oriented Programming Primer ',
        'tagline' => '',
        'talk_description' => 'Whether you are a brand new developer or an experienced coder - the PHP object model can hold some mysteries that are worth exploring. This session will briefly cover the basics of working with Objects in PHP, then dive quickly through inheritance, abstracts, interfaces, traits, late static binding, magic methods, namespaces and maybe even reflection. It\'s a lot to cover to make sure to show up with your eyes open and ready to move quickly!',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T14' => array(
        'speaker' => array (
            array (
                'name' => 'Stefany Newman',
                'img' => 'stefany_newman.png',
                'bio' => 'I am a programmer and a freelance web developer. In my spare time I love to read history, ride bikes, and play Go. I also love programming. I think it is the best thing in the world to do and to be. I love the freedom that being a programmer gives me. I live by the maxim "If you stop being better, you stop being good" so I try to better myself every day, in the programming field. I live in Arkansas with my lovely husband whom I like to annoy with constant web development chatter (he isn\'t annoyed, he just doesn\'t understand). My personal website is <a href="http://www.StefanyNewman.info">www.StefanyNewman.info</a>.',
                'twitter' => '',
            ),
        ),
        'title' => 'Illusions of Web Development and How They Are Destroying the Industry',
        'tagline' => '',
        'talk_description' => 'Web development (or web programming as I like to call it) is filled with illusions. These illusions, masquerading as common sense, are things like attempting to be "time saving" and tidbits like "don\'t re-invent the wheel" that are widespread among programmers and web developers. Though good intentioned, these illusions mislead us as web programmers to take the wrong path when building a website. In this talk, I want to bust some of these illusions and mistakes; like using content management systems for single page websites when a simple HTML page will suffice, or installing ultra heavy CSS frameworks when just 500 lines of CSS will be needed, or using a standard shopping cart that your cousin\'s best friend\'s sister uses and you want it for your ecommerce shop when you are selling just one product and don\'t need it (true story). I want to talk about things like that. I see websites being built in a horrible fashion daily and this is not how web development was supposed to be.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T15' => array(
        'speaker' => array (
            array (
                'name' => 'Andrea Roenning',
                'img' => 'andrea_roenning.jpg',
                'bio' => 'Andrea Roenning is a Web Developer and Designer at Forte Research Systems in Madison, WI where she develops and manages several WordPress sites. After studying to be a journalist in college, Andrea started building websites in 2001. She became a full stack developer out of necessity as problems needed to be solved, thanks largely to the support of the web community. When she\'s not writing code, Andrea is probably outside, cross country skiing, hiking, cycling or running with her three-legged labrador. To learn more, visit <a href="http://andrearoenning.com">http://andrearoenning.com</a>',
                'twitter' => 'andreaincode',
            ),
        ),
        'title' => 'Building Unique Templates with Custom Post Types in WordPress',
        'tagline' => '',
        'talk_description' => 'Custom Post Types help extend WordPress\'s super powers to provide a more versatile content management system. They help create a WordPress administrator experience that makes it easy to add and edit repetitive content and gives you flexibility to create unique web pages to fit your, or your customers\' unique needs. This talk will cover creating Custom Post Types and how to create a WordPress template page to display their content.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T17' => array(
        'speaker' => array (
            array (
                'name' => 'Patrick Schwisow',
                'img' => 'patrick_schwisow.jpg',
                'bio' => 'Patrick has been into web technologies since the "bad old days" when animated GIFs were required on all sites and the BLINK tag still had some supporters. He suffered through several years of procedural programming in PHP4 before discovering the glories of OOP in PHP5. Patrick is a Software Engineer at Shutterstock, with experience in Doctrine, Symfony, and several less fun technologies. After hours, he works on supporting the PHP Community and contributing to the Phergie IRC Bot.',
                'twitter' => 'PSchwisow',
            ),
        ),
        'title' => '10 Things You Didn\'t Know You Could Do With Composer',
        'tagline' => '',
        'talk_description' => 'Over the last five years, Composer has changed the way PHP developers work. It figures out which versions of our required libraries work together and installs everything for us, but if that\'s all you\'ve ever used Composer for, you\'re missing out. Come learn how and when to use validation, autoload overrides, and other features you\'ve never heard of.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T19' => array(
        'speaker' => array (
            array (
                'name' => 'Emily Stamey',
                'img' => 'emily_stamey.jpg',
                'bio' => 'Emily Stamey works at InQuest, a network security company based in Washington, DC. She learned PHP in 1999 and loved it. This ignited her passion for Open Source! In her free time she enjoys music, legos, making things, playing games, and socializing. She is an active volunteer in the community as Director of Women Who Code Raleigh/Durham, Organizer of TrianglePHP, and volunteers for Girl Develop It. She enjoys helping people share ideas and learn together, which has led to her speaking at conferences.',
                'twitter' => 'elstamey',
            ),
        ),
        'title' => 'Pulling up Your Legacy App by Its Bootstraps!',
        'tagline' => '',
        'talk_description' => 'Your mission, should you choose to accept it, is to support an application built on an older framework. Refactoring isn\'t an easy option. The code is untested and nowhere near best practices or standards. In this session, we\'ll talk about strategies to incorporate modern PHP coding practices to add features and functionality and retiring the older code in pieces. We\'ll review specific examples and code from a real project where we bootstrapped a legacy application that needed a lot of help to become useful to its users and simpler for developers to maintain. We\'ll talk about strategies to leave the existing code in place until the new code is ready to replace it in whole or in pieces. Attendees will learn common terminology around legacy codebases, strategies for assessing the state of the legacy application before deciding how to proceed, and the tools that were crucial to our refactoring project. The specific tools are from the PHP ecosystem, but they are applicable in other legacy environments (testing packages, package manager, database migration tool, and dependency injection container tools) - general ideas of how the Events, CQRS, and DDD worked to help us improve our application.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T20' => array(
        'speaker' => array (
            array (
                'name' => 'Matthew Turland',
                'img' => 'matthew_turland.jpg',
                'bio' => 'Matthew Turland has been working with PHP since 2002. He has been both an author and technical editor for php|architect Magazine, spoken at multiple conferences, and contributed to numerous PHP projects. He holds the PHP 5 and Zend Framework ZCE certifications and is the author of "php|architect\'s Guide to Web Scraping with PHP" and co-author of SitePoint\'s "PHP Master: Write Cutting-Edge Code." In his spare time, he likes to bend PHP to his will to scrape web pages and run IRC bots.',
                'twitter' => 'elazar',
            ),
        ),
        'title' => 'What Makes a Great Developer?',
        'tagline' => '',
        'talk_description' => 'Regardless of our technical specialization, seniority level, or present job, we want to be the best developers we can be. On our individual journeys, we meet others we hold in high regard and consider to be exemplary of our vocation and our craft. What makes these developers great? How can we best follow their example? We\'ll explore these and related questions about what crucial knowledge, values, skills, goals, and challenges you must pursue on your own path to being a great developer.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T21' => array(
        'speaker' => array (
            array (
                'name' => 'Michelangelo van Dam',
                'img' => 'michelangelo_van_dam.jpg',
                'bio' => '<a href="http://www.dragonbe.com">Michelangelo</a> is a veteran PHP consultant working at <a href="https://www.in2it.be">in2it</a>, community leader for <a href="https://www.phpbenelux.eu">PHPBenelux</a>, coach and mentor for kids at <a href="https://www.coderdojo.org">CoderDojo</a> and a global conference speaker. Get him a coffee and he will tell you all about testing, continuous deployments, cloud or community work.',
                'twitter' => 'DragonBe',
            ),
        ),
        'title' => 'The Road to PHP 7.1',
        'tagline' => '',
        'talk_description' => 'In December 2015, PHP 7.0 was released, marking a new milestone for PHP and web application developers. Looking at the changelog and removed functions, we thought all was going to be easy to migrate to PHP 7.0. Unfortunately, many of the extensions and tools we use weren\'t ready yet. In December 2016, PHP 7.1 was released and the urgency to update became real as PHP 5.6 was nearing end-of-life. In this talk, I describe the analysis and the challenges we faced migrating towards PHP 7.1 so you can learn how to defeat those challenges if you plan to migrate too.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),
    'T23' => array(
        'speaker' => array (
            array (
                'name' => 'Liam Wiltshire',
                'img' => 'liam_wiltshire.jpg',
                'bio' => 'Liam is a UK based Senior PHP Developer &amp; Business Manager at Tebex, creators of <a href="http://www.buycraft.net">Buycraft.net</a>, the first e-commerce platform for Minecraft. In his nine years as a dev, he\'s tackled projects large and small, from multi-million pound eCommerce sites to the plumber down the road looking for \'mates\' rates. These days Liam focuses on providing gCommerce platforms for multiplayer sandbox games, and in his spare time is trying to learn the secret to actually having some spare time.',
                'twitter' => 'l_wiltshire',
            ),
        ),
        'title' => 'RegEx Is Your Friend',
        'tagline' => '',
        'talk_description' => 'RegEx is scary. At least, if you ask Google, that\'s what you might think (257,000). And slow (441,000). In fact, regular expressions are neither of these, and indeed are a powerful tool in your utility belt. "RegEx Is Your Friend" will provide some real-world usable examples of how RegEx can be used in a way that\'s fast, explaining how the different parts of regular expressions work and execute to make it understandable for all. No matter if you don\'t know your \'$\' from your \'^\', you are not sure when to use RegEx (and when not to), or you just need to find a way to make your RegEx run faster, there will be useful help and tips for everyone.',
        'talk_type' => 'talk',
        'display_speaker' => 'yes',
    ),**/
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
