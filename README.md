The Timetracker plugin for cakephp 2.x allow you manage your working time.

#Requirements

##Database Fields

CREATE TABLE users (
    id bigserial NOT NULL,
    firstname character varying(255) NOT NULL,
    laststname character varying(255) NOT NULL,
    comment text,
    created timestamp without time zone,
    modified timestamp without time zone
);

#Installation

Clone from github : in your plugin directory type git clone git://github.com/freega/timeTracker.git timeTracker
Add as a git submodule : in your plugin directory type git submodule add git://github.com/freega/timeTracker.git timeTracker
Download an archive from github and extract it in /Plugin/timeTracker