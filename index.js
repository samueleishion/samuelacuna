var express = require('express'),
	request = require('request'),
	path = require('path'),
    app = express();

app.use(express.static('static'));

app.listen(2300); 
