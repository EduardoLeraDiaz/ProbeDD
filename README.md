# DDApi

You can use the api with a web server or thought CLI.
For both is web/app.php the main file.

### Instructions for CLI

    php web/app.php command=<command> api-key=<Api Key> [other-parameters=other-value,..]

### Instructions Web Server

app.php must requested with GET parameters for the command,api-key and others


### Commands:
Here is the list of the commands with a list of the parameters that they have to be used.
  
    create_leave_request
        api_key
        date_start
        date_end
        comment
#
    list_leave_request
        api_key
     
    list_managed_leave_request
        api_key
        
    handle_leave_request 
        api_key
        leave_request_id
        status
        comment
        
        
### Command Examples

  web/app.php command=create_leave_request api_key=apiKey1 date_start=2016-10-10 date_end=2016-10-10 comment="I have a date with the doctor"
  web/app.php command=list_leave_request api_key=apiKey1
  web/app.php command=list_managed_leave_request api_key=apiKey6 
  web/app.php command=handle_leave_request api_key=apiKey6 leave_request_id=1 status=accepted
  
### Example data
  
  In the folder  DataExample you can find csv files to be used as exampledata. You can copy them to the Data folder to start with some data
  the scripts in the web folder 1prepareEmployess.php and 2addLeaveRequest.sh can be used as well to introduce that same data to the system. 
  
  