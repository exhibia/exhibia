<?php

	#PHP examples for using the Infusion API.  The library used above
	#can be found at http://phpxmlrpc.sourceforge.net/
	
	#This example will perform three functions:
	#	1.  Add a new contact record
	#	2.  Add the newly created contact to a group
	#	3.  Look up a list of all contacts that belong to that group

    include("xmlrpc-2.0/lib/xmlrpc.inc");

	#The client object will set up a connection to the server that can be re-used for
	#later calls
	#This was split from the URL https://mach2.infusionsoft.com:80/api/xmlrpc
	$client = new xmlrpc_client("/api/xmlrpc", "marty.infusionsoft.com", 443);
	
	#This will make it so we get back raw php types - they are easier to work with 
	$client->return_type = "phpvals";

	#The encrypted API key
	$key = "6ae189d497cd486b9db53793ccf98646";

	
	#--------------------------------------   ADD CONTACT   ---------------------------------------#
	#----------------------------------------------------------------------------------------------#
	#The contact variables sets up the data as it will be added to the database
	$contact = array(
		"FirstName" => "Eric",
		"LastName" => "Martineau",
		"Email" => "ericm@infusionsoft.com"
	);

	#This sets up the call.  DataService.add is the name of the service, and the second array
	#is a list of the parameters
	$call = new xmlrpcmsg("DataService.add", array(
		php_xmlrpc_encode($key), 		#The encrypted API key
		php_xmlrpc_encode("Contact"),	#The table we are adding to
		php_xmlrpc_encode($contact)		#The data to be added
	));

	#This actually makes the call and stores the result in $result
	$result = $client->send($call);

	#Check to see if we have an error. If not, print out the results. 
	if(!$result->faultCode()) {
		print "Contact added was " . $result->value();
		print "<BR>";
	} else {
		print $result->faultCode() . "<BR>";
		print $result->faultString() . "<BR>";
	}

    #--------------------------------------   ADD TO GROUP  ---------------------------------------#
    #----------------------------------------------------------------------------------------------#
	$groupId = 97;
	$contactId = $result->value();
	$call = new xmlrpcmsg("ContactService.addToGroup", array(
		php_xmlrpc_encode($key),
		php_xmlrpc_encode($contactId),
		php_xmlrpc_encode($groupId)
	));
	
	$result = $client->send($call);
	if(!$result->faultCode()) {
        print "Result of group add " . $result->value();
		print "<BR>";
    } else {
        print $result->faultCode() . "<BR>";
        print $result->faultString() . "<BR>";
    }


    #--------------------------------------   LIST ALL IN GROUP------------------------------------#
    #----------------------------------------------------------------------------------------------#
	$call = new xmlrpcmsg("DataService.findByField", array(
		php_xmlrpc_encode($key),	
		php_xmlrpc_encode("ContactGroupAssign"),   				#The table to search in
		php_xmlrpc_encode(50),									#The number of records to return
		php_xmlrpc_encode(1),									#What page to display
		php_xmlrpc_encode("GroupId"),							#Field to search on
		php_xmlrpc_encode($groupId),							#Data to query on
		php_xmlrpc_encode(array("ContactGroup", "ContactId")))	#What fields to select
	);
	$result = $client->send($call);
	if(!$result->faultCode()) {
		#The results are returned as an array of structs (stored as referenced arrays)
		#Loop through each item and print values out to screen
		foreach ($result->value() as $item) {
			print "Contact " . $item["ContactId"] . " was added to group " . $item["ContactGroup"];
			print "<BR>";
		}
    } else {
    	print $result->faultCode() . "<BR>";
    	print $result->faultString() . "<BR>";
    }



?>

