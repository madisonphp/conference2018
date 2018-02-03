<?php
date_default_timezone_set('America/Chicago');

header("Content-type: text/plain"); // be explicit to avoid accidental XSS

$gitpath = '/usr/local/bin/git';
chdir(__DIR__ . '/../'); // rarely actually an acceptable thing to do
system("/usr/bin/env -i {$gitpath} pull 2>&1"); // main repo (current branch)
