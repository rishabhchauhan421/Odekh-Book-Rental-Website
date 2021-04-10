'use strict';

var advicePage=angular.module('advicePage',[]);

    
advicePage.controller('adviceController',function faqsController($scope){
    $scope.advice_product=[
    {
        id:"product_1",
		title:'C Programming Language',
        beginner:'Ansi C by E balagurswamy',
		advanced:'Let us C by yashwant kanetkar',
		expert:'C Programming Language by Dennis Ritchie'
    },{
        id:"product_2",
		title:'C++ Programming Language',
        beginner:"",
		advanced:"",
		expert:""
    },{
        id:"product_3",
		title:'Java Programming Language',
        beginner:"",
		advanced:"",
		expert:""
    },{
        id:"product_4",
		title:'Algorithms Programming Language',
        beginner:"",
		advanced:"",
		expert:""
    }];
});


