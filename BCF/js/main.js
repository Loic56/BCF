function loadAjaxUrl(url, selector) {
	$.ajax({
		url : url,
		cache : false
	}).done(function(html) {
		$(selector).empty();
		$(selector).append(html);
	});
};

function postAjax(url,form, selector) {
	// let's select and cache all the fields
    var $inputs = $(form).find("input, select, textarea");
    // serialize the data in the form
    var serializedData = $(form).serialize();
    console.log(serializedData);
    
	$.ajax({
		type: "post",
		url : url,
		cache : false,
		
		data: serializedData
	}).done(function(html) {
		$(selector).empty();
		$(selector).append(html);
	});
};



function postAjax2(url,form, selector) {
	// let's select and cache all the fields
    var $inputs = $(form).find("input");
    // serialize the data in the form
    var serializedData = $(form).serialize();
    console.log(serializedData);
    
	$.ajax({
		type: "post",
		url : url,
		cache : false,
		data: serializedData
	}).done(function(html) {
		$(selector).empty();
		$(selector).append(html);
	});
};

function loadAjax2(data, selector, myreq) {
	if(myreq==null)
		md='TestServlet';
	else
		md = 'TestServlet' + myreq;
		
	$.ajax({
		url : md,
		cache : false,
		data: data
	}).done(function(html) {
		$(selector).empty();
		$(selector).append(html);
	});
};


//function loadAjax2(data, selector, myreq) {
//	if(myreq==null)
//		md='TestServlet';
//	else
//		md = 'TestServlet' + myreq;
//		
//	$.ajax({
//		url : md,
//		cache : false,
//		data: data
//	}).done(function(html) {
//		$(selector).empty();
//		$(selector).append(html);
//	});
//};