The Timetracker plugin for cakephp 2.x allow you manage your working time.

#Requirements

###Database Fields

    CREATE TABLE users (  
        id bigserial NOT NULL,  
        firstname character varying(255) NOT NULL,  
        laststname character varying(255) NOT NULL,  
        comment text,  
        created timestamp without time zone,  
        modified timestamp without time zone  
    );  

#Installation

Clone from github :  
in your plugin directory type 

        git clone git://github.com/freega/cakephp-timetracker-plugin.git TimeTracker 
        
Add as a git submodule :  
in your plugin directory type 

        git submodule add git://github.com/freega/cakephp-timetracker-plugin.git TimeTracker  
        
Download an archive from github and extract it in /Plugin/TimeTracker  

#Configuration  
Add in AppModel :  
class AppModel extends Model {  

        var $recursive = -1;  

        public $validationDomain = "validation_errors";
}

