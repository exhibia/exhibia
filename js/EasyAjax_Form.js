/*
*
* EasyAjax_Form Script
* 
* Copyright 2009 John Stevens.  
*
* Get this script at Themeforest.net : 
* http://themeforest.net/item/easyajax_form/57497
*
* Requires jQuery 1.3+
*
* version 5.5
*
*/

EasyAjax_Form = function () {
	
	/*
	 * Configuration Options
	 */
	 
	var config = {};
	
	config = {
		errorMsgs: {
			required: 'This is a required field.',
			email: 'Please enter a valid email address.',
			phone: 'Example: 111-222-3333.',
			lengthInput: '50 or fewer characters for this field.',
			lengthText: '5000 or fewer characters for this field.',
			ruHuman: 'Incorrect single digit number',
			ajaxTimeout: 'An error occurred when saving your request, please try again.' +  
				'If this problem persists, please try again later.'				  
		},
		ruHuman: {
			answer: '4'
		},
		fades: {
			validation: 200, /*The time it takes validation messages to fade in.*/
			ajax: 500 /*The time it takes ajax communicaiton to fade in and out.*/
		},
		ajaxTimers: {
			pause: 2000, /*Ajax message sent to server is delayed by this amount.*/
			timeout: 10000 /*Will return the ajax_timeout error message if no server response in this amount of time*/
		},
		valClasses: { /*Customize the class names used in the HTML that will trigger Validation actions in this script.*/
			requiredField: 'REQUIRED',
			emailField: 'EMAIL',
			phoneField: 'PHONE',
			charLengthInput: 'LENGTH_INPUT',  /*Default is 50 characters, useful for regular input fields*/
			charLengthText: 'LENGTH_TEXT',    /*Useful for text areas.  Default is 5000 characters (about 800 words) */
			optionalField: 'OPTIONAL',
			ruHumanField:'RU_HUMAN'
		},
		formClasses: {   /*Customize the class names used in the HTML that will trigger Ajax actions in this script*/
			validateOnly: 'VALIDATE',
			ajaxOnly: 'AJAX',
			disable: 'DISABLE',
			choose: 'CHOOSE'
		},
		cssSelectors: { /*Customize class & ID names used in the CSS file.  Make sure to update the CSS file if you change these*/
			validationPass: 'PASS',  
			validationFail: 'FAIL',
			ajaxLoading: '#FORM_LOAD', /* # needed as it is used as a jQuery selector in this script, this is an ID.*/
			ajaxTimeout: "AJAX_TIMEOUT", /*Reccomend keep double quotes*/
			ajaxResponse: "AJAX_RESPONSE" /*Reccomend keep double quotes*/
		},
		regExps: { /*Contains regular expressions used later in the script*/
			email: /^\w+([\.\-]?\w+)*@\w+([\.\-]?\w+)*(\.\w{2,3})+$/,
			phone: /^\(?(\d{3})\)?[\.\-\/ ]?(\d{3})[\.\-\/ ]?(\d{4})$/
		}, 
		charLimit: {
			input: 50,
			textArea: 5000
		}
	};
	
	/*
	 * I use the jQuery $.each function for looping in this script.  I find it easier to read and work with
	 * and it does all the necessary type checking, etc behind the scenes.  In my mind it is well worth the 
	 * slightly, slightly, slightly slower processing.  In my experience I've seen no perceptible performance 
	 * difference. 
	 *
	 * See the following url for more information on $.each : 
	 * http://docs.jquery.com/Utilities/jQuery.each
	 */
	
	/*
	 * General Helper Functions
	 */
	
	function appendSpan(allFields) {   /*Appends an empty span element after each form field found in the HTML*/
		$.each(allFields, function (i, field) {     
			$('<span></span>').insertAfter(this);		 			 
		});
	}
	function hasClassArray_maker(currentField, formLevel) { /*Populates the HasClass Array for a given form field when needed.*/
		var hasClassArray = [],
			Classes = config.valClasses,
			j = 0; 
		if (formLevel) { /*Makes the second paramenter optional. Is passed true from the init function, null for validation uses*/
			Classes = config.formClasses;
		}
		$.each(Classes, function (k, currentClass) {       
			if ($(currentField).hasClass(currentClass)) {
				hasClassArray[j] = currentClass;
				j = j + 1;
			}	
		});	
		return hasClassArray;
	}
	function fieldProperty_maker(currentField) {
		var valTypes = config.valClasses,  /*The keys of valClasses object will describe all possible field properties*/
			fieldProperties = {}; 
		$.each(valTypes, function (l, currentType) {
			fieldProperties[l] = false;								   
		});
		return fieldProperties;
	}
	function calcFieldProperties(fieldProperties, hasClassArray) { /*Based on classes present, determines what validation is indicated*/
		$.each(hasClassArray, function (m, currentClass) {   	
			switch (currentClass) {            
			case config.valClasses.emailField:    
				fieldProperties.emailField = true;
				break;
			case config.valClasses.requiredField:
				fieldProperties.requiredField = true;
				break;										
			case config.valClasses.phoneField:
				fieldProperties.phoneField = true;
				break;
			case config.valClasses.charLengthInput:
				fieldProperties.charLengthInput = true;
				break;									
			case config.valClasses.charLengthText:
				fieldProperties.charLengthText = true;
				break;
			case config.valClasses.ruHumanField: 
				fieldProperties.ruHumanField = true;
			default:
				break;
		    }	
	    }); 
	    return fieldProperties;	
	}
	function boolObjDecoder(boolObj, retFalseIf) { /*Returns false if any value in the object is equal to the second paramenter (true or false)*/
		var x = 0; 
		$.each(boolObj, function (p, currentBool) {
			var booleanKeepGoing;					  
			if (currentBool === retFalseIf) {
				x = 1;
				booleanKeepGoing = false;
			}
		}); 
		if (x === 1) {
			return false; 
		}
		return true;
	}
	/*
 	 * Ajax Helper Functions
     */	
	 
	function ajaxError(daddy, thisForm) {  /*Is called in the case of a timeout error*/
		$(config.cssSelectors.ajaxLoading).fadeOut(config.fades.ajax / 4, function () {
			$(this).remove();
		});  
		$('<div id="Response">' +
		  	'<p class=' + config.cssSelectors.ajaxTimeout + '>' + config.errorMsgs.ajaxTimeout + '</p>' +
			'</div>').hide().appendTo(daddy).fadeIn(config.fades.ajax);
		$('<div id="Refresh">' +
		  	'<p><a href ="#">Click here</a> to re-enter form information.</p>' +
			'</div>').hide().appendTo(daddy).fadeIn(config.fades.ajax);
		$('#Refresh').click(function () {
			$('#Response, #Refresh').fadeOut(config.fades.ajax / 2, function () {
				$('#Response, #Refresh').remove();										  
				$(thisForm).fadeIn(config.fades.ajax / 2);											  
			});
			return false;
		});
		return true;
	}
	function ajaxSuccess(serverResponse, daddy, thisForm) {
		$(config.cssSelectors.ajaxLoading).fadeOut(config.fades.ajax / 4, function () {
			$(this).remove();
		});		   
		$('<div id="Response">' +
			'<p class=' + config.cssSelectors.ajaxResponse + '>' + serverResponse + '</p>' +
			'</div>').hide().appendTo(daddy).fadeIn(config.fades.ajax);  
		$('<div id="Refresh">' +
			'<p><a href ="#">Click Here</a> to re-enter form information.</p>' +
			'</div>').hide().appendTo(daddy).fadeIn(config.fades.ajax);  
		$('#Refresh').click(function () {   
			$('#Response, #Refresh').fadeOut(config.fades.ajax / 2, function () {
				$('#Response, #Refresh').remove();										  
				$(thisForm).fadeIn(config.fades.ajax / 2);	
			});
			return false;
		});	
		return true;
	} 
	
	/*
	 * Validation Helper Functions
	 */
	 
	function requiredValidator(currentField, input) {
		var thisError = config.errorMsgs.required,            
			hasReqErr = false;  
		if (input === '') { 
			$(currentField).next().removeClass(config.cssSelectors.validationPass);
			$(currentField).next().hide().addClass(config.cssSelectors.validationFail).
				text(thisError).fadeIn(config.fades.validation);
			hasReqErr = true;  
		}	
		return hasReqErr;    
	}
	function emailValidator(currentField, input) {
		var thisError = config.errorMsgs.email,            
			hasEmailErr = false,
			reEmail = config.regExps.email; 
		if (!reEmail.test(input)) {                          
			$(currentField).next().removeClass(config.cssSelectors.validationPass);
			$(currentField).next().hide().addClass(config.cssSelectors.validationFail).
				text(thisError).fadeIn(config.fades.validation);
			hasEmailErr = true;  
		}	 
		return hasEmailErr;   		
	}
	function phoneValidator(currentField, input) {
		var thisError = config.errorMsgs.phone,            
			hasPhoneErr = false,
			rePhone = config.regExps.phone; 
		if (!rePhone.test(input)) {                          
			$(currentField).next().removeClass(config.cssSelectors.validationPass);
			$(currentField).next().hide().addClass(config.cssSelectors.validationFail).
				text(thisError).fadeIn(config.fades.validation);
			hasPhoneErr = true;  
		}	 
		return hasPhoneErr;   		
	}
	function inputLengthValidator(currentField, input) {
		var thisError = config.errorMsgs.lengthInput,            
			hasInputLengthErr = false;
		if (input.length > config.charLimit.input) {                          
			$(currentField).next().removeClass(config.cssSelectors.validationPass);
			$(currentField).next().hide().addClass(config.cssSelectors.validationFail).
				text(thisError).fadeIn(config.fades.validation);
			hasInputLengthErr = true;  
		}	 
		return hasInputLengthErr; 		
	}
	function textLengthValidator(currentField, input) {
		var thisError = config.errorMsgs.lengthText,            
			hasTextLengthErr = false;
		if (input.length > config.charLimit.textArea) {                          
			$(currentField).next().removeClass(config.cssSelectors.validationPass);
			$(currentField).next().hide().addClass(config.cssSelectors.validationFail).
				text(thisError).fadeIn(config.fades.validation);
			hasTextLengthErr = true;  
		}	 
		return hasTextLengthErr; 
	}
	function ruHumanValidator (currentField, input){ 
		var thisError = config.errorMsgs.ruHuman,
			hasRuHumanErr = false;
		if(input !== config.ruHuman.answer){
			$(currentField).next().removeClass(config.cssSelectors.validationPass);
			$(currentField).next().hide().addClass(config.cssSelectors.validationFail).
				text(thisError).fadeIn(config.fades.validation);
			hasRuHumanErr = true;	
		}
		return hasRuHumanErr;
	}
	function fieldValidator(fieldProperties, input, currentField) {  /*This function is called by the Main Functions (below) and in turn calls the specific validation types (above)*/
		var errorObject = {}; 
		errorObject = {
			requiredError: false,
			emailError: false, 
			phoneError: false,
			inputLengthError: false,
			textLengthError: false,
			ruHumanError: false
		};
		if (fieldProperties.requiredField) {
			errorObject.requiredError = requiredValidator(currentField, input);
			if (errorObject.requiredError) {
				return errorObject;
			}	
		}  
		if (fieldProperties.emailField) {
			errorObject.emailError = emailValidator(currentField, input);
			if (errorObject.emailError) {
				return errorObject;	
			}
		}
		if (fieldProperties.phoneField) {
			errorObject.phoneError = phoneValidator(currentField, input);
			if (errorObject.phoneError) {
				return errorObject;	
			}
		}
		if (fieldProperties.charLengthInput) {
			errorObject.inputLengthError = inputLengthValidator(currentField, input);
			if (errorObject.inputLengthError) {
				return errorObject;
			}
		}
		if (fieldProperties.charLengthText) {
			errorObject.textLengthError = textLengthValidator(currentField, input);
			if (errorObject.textLengthError) {
				return errorObject;	
			}
		}
		if (fieldProperties.ruHumanField) {
			errorObject.ruHumanError = ruHumanValidator(currentField, input);
			if (errorObject.ruHumanError) {
				return errorObject;	
			}
		}
		return errorObject;	
	}
	function greenChecker(currentField) { /*Adds a green check if validation passes*/
		$(currentField).next().removeClass('FAIL');
		if ($(currentField).next().hasClass("PASS")) {
			return;
		}
		$(currentField).next().hide().addClass("PASS").text('').fadeIn(config.fades.validation);	
	}

	
	/*
	 * Main Functions
	 */
	 
	function validate_onBlur(formID, allInputs) { 
		$(allInputs).blur(function () {
			var allValClasses = {}, 
				currentField = this,     
  				input = $(currentField).val(),		
  				blankOptInput = false,
				hasClassArray = [], 
				fieldProperties = {}, /*An object of booleans describing what validation is needed for this field.*/
				validationTracker = {},
				validationResults = true; /*Initializes the validationResults with a true (as in validation passes)*/	
			allValClasses = config.valClasses;	
			hasClassArray = hasClassArray_maker(currentField); /*Holds which classes from config.valClasses are present in this form element*/
			fieldProperties = fieldProperty_maker(currentField);  /*Initializes all field properties with false*/			
			if (input === '' && $(currentField).hasClass(config.valClasses.optionalField)) { /*Determine if field is blank & optional*/ 
				blankOptInput = true;
			}
			if (hasClassArray.length !== 0) {
				fieldProperties = calcFieldProperties(fieldProperties, hasClassArray); /*Based on classes present, determines what validation is indicated*/
				if (!blankOptInput) {
					validationTracker = fieldValidator(fieldProperties, input, currentField); /*validationTracker will contain a true for one of its values if there are any validation errors.*/
				}
				validationResults = boolObjDecoder(validationTracker, true); /*validationResults will be false if the validationTracker object contains any value of true (if a valdiation error is returned)*/
			}
			if (validationResults) { /*if true, give a green check to this field*/ 
				greenChecker(currentField);
			} 	
		});		 
	}
	function validate_onSubmit(formID, allFields) { /*See the validate_onBlur function for more notes. Only new stuff is noted here.*/
		$("" + formID + "").submit(function () { 							
			var allValClasses = {},	   
		   		allGood = [], /*Will be populated with booleans for each field. If all true, the form passes validation*/
				formValid = false;
			allValClasses = config.valClasses;	
			$.each(allFields, function (r, currentField) { /*For each form field, do the following (run validation)*/				     
				var	input = $(currentField).val(),		
  					blankOptInput = false,
					hasClassArray = [], 
					fieldProperties = {}, 
					validationTracker = {},
					validationResults = true; 
				allGood[r] = false; 
				hasClassArray = hasClassArray_maker(currentField); 
				fieldProperties = fieldProperty_maker(currentField);   
				if (input === '' && $(currentField).hasClass(config.valClasses.optionalField)) {  
					blankOptInput = true;
				}
				if (hasClassArray.length !== 0) {
					fieldProperties = calcFieldProperties(fieldProperties, hasClassArray); 
					if (!blankOptInput) {
						validationTracker = fieldValidator(fieldProperties, input, currentField); 
					}
					validationResults = boolObjDecoder(validationTracker, true); 
				}
				if (validationResults) { /*if true, give a green check to this field*/ 
					allGood[r] = true;
					greenChecker(currentField);
				} 						   
			});
			formValid = boolObjDecoder(allGood, false);
			if (formValid) {
				return true; 
			}
			return false;
		});
		
	}
	function ajaxOnly(formID, allFields) { 
		$("" + formID + "").submit(function () { 						
			var thisForm = this,					  
		  		toFile = this.action,           
		  		daddy = $(this).parent(),  	
		 		dataString = $(this).serialize();  /*jQuery function to make form data as portable as possible*/
		    $(thisForm).fadeOut(config.fades.ajax, function () {   
				$("<div id='FORM_LOAD'/>").hide().appendTo(daddy).show();   	 									  
			});	  							
			$.ajax({
				type: "post",
				url: toFile,
				data: dataString,
				timeout: config.ajaxTimers.timeout,                   
				error: function (XMLHttpRequest, timeout) { /*Run the following in the event of a timeout error*/
					setTimeout(function () {
						ajaxError(daddy, thisForm);	
					}, config.fades.ajax + 10);  /*Timeout here to take the fade into account, otherwise the loading div may not be removed*/
				},
				success: function (serverResponse) {           
					setTimeout(function () { /*Response function delayed in order to show the loading icon for a perceptible amount of time*/
						ajaxSuccess(serverResponse, daddy, thisForm);
					}, config.fades.ajax + config.ajaxTimers.pause);  
				}
			});
			return false; 	
		});
	}
	function validatePlusAjax_onSubmit(formID, allFields) { /*See the above main functions for more notes, only new stuff is noted here.*/
		$("" + formID + "").submit(function () { 							
			var allValClasses = {},	   
		   		allGood = [], 
				formValid = false,
				thisForm = this, /*Start: Ajax Variables*/
				toFile = this.action,           
		  		daddy = $(this).parent(),  	
		 		dataString = $(this).serialize(); /*End: Ajax Variables*/
			allValClasses = config.valClasses;	
			$.each(allFields, function (r, currentField) { 
				var	input = $(currentField).val(),	 /*Start: Validation variables*/   	
  					blankOptInput = false,
					hasClassArray = [], 
					fieldProperties = {}, 
					validationTracker = {},
					validationResults = true; /*End: Validation variables*/					  
				allGood[r] = false; 
				hasClassArray = hasClassArray_maker(currentField); 
				fieldProperties = fieldProperty_maker(currentField);   
				if (input === '' && $(currentField).hasClass(config.valClasses.optionalField)) {  
					blankOptInput = true;
				}
				if (hasClassArray.length !== 0) {
					fieldProperties = calcFieldProperties(fieldProperties, hasClassArray); 
					if (!blankOptInput) {
						validationTracker = fieldValidator(fieldProperties, input, currentField); 
					}
					validationResults = boolObjDecoder(validationTracker, true); 
				}
				if (validationResults) { /*if true, give a green check to this field*/ 
					allGood[r] = true;
					greenChecker(currentField);
				} 						   
			});
			formValid = boolObjDecoder(allGood, false);
			if (formValid) {
			    $(thisForm).fadeOut(config.fades.ajax, function () {   
					$("<div id='FORM_LOAD'/>").hide().appendTo(daddy).show();   	 									  
				});	
				$.ajax({
					type: "post",
					url: toFile,
					data: dataString,
					timeout: config.ajaxTimers.timeout,                   
					error: function (XMLHttpRequest, timeout) { 
						setTimeout(function () {
							ajaxError(daddy, thisForm);	
						}, config.fades.ajax + 10);
					},
					success: function (serverResponse) {           
						setTimeout(function () {
							ajaxSuccess(serverResponse, daddy, thisForm);
						}, config.fades.ajax + config.ajaxTimers.pause);  
					}
				});				 
			}
			return false;
		});		
		
	}
	
	/*
	 * Class Reader Functions: <form> Element
	 *
	 * These read the class attribute of the <form> tag to determine which
	 * main functions above will be utilized.
	 */
	 
	function chooseID(formID) {  /*Called in the case where the user chooses the form by ID*/
		var allFields;
		if (formID) {
			formID = '#' + formID;
		} else {
			formID = "form";
		}
		allFields = $('' + formID + ' :input:not(:submit):not(:button):not(:image)'); 
		if ($(formID).hasClass(config.formClasses.validateOnly)) {	
			validate_onBlur(formID, allFields); 
			validate_onSubmit(formID, allFields);
			return;
		} else if ($(formID).hasClass(config.formClasses.ajaxOnly)) {
			ajaxOnly(formID, allFields);
			return;
		} else {
			validate_onBlur(formID, allFields); 
			validatePlusAjax_onSubmit(formID, allFields);
			return;
		}
	}
	function init() {
		var formID = "form", 
			allFields = $('' + formID + ' :input:not(:submit):not(:button):not(:image)'); 
		appendSpan(allFields); /*If you are using Ajax Only, this line can be deleted.*/
		if ($(formID).hasClass(config.formClasses.disable)) {
			return;	
		} else if ($(formID).hasClass(config.formClasses.choose)) {
			return;		
		} else if ($(formID).hasClass(config.formClasses.validateOnly)) {	
			validate_onBlur(formID, allFields); 
			validate_onSubmit(formID, allFields);
			return;
		} else if ($(formID).hasClass(config.formClasses.ajaxOnly)) {
			ajaxOnly(formID, allFields);
			return;
		} else {
			validate_onBlur(formID, allFields); 
			validatePlusAjax_onSubmit(formID, allFields);
			return;
		}
	}
	
	/*
	 * EA_Form Public Pointers
	 *
	 * These pointers are used for access from the outside. 
	 * Notice the name changes for outside access.
	 */
	
	return {
		CustomMessages: config.errorMsgs,
		CustomFades: config.fades,
		CustomTimers: config.ajaxTimers,
		CustomCharLimits: config.charLimit,
		Go: init, 
		ByID: chooseID
	}; 
}(); /*End EasyAjax_Form Function*/

$(function () {
	EasyAjax_Form.Go();
});
