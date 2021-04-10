'use strict';

var faqsPage=angular.module('faqsPage',[]);

    
faqsPage.controller('faqsController',function faqsController($scope){
    $scope.faqs_general=[
    {
        id:"general_1",
		question:'How does Odekh work?',
        answer:"After signing up, browse the Web site and add titles to your cart by clicking the Add to Cart button. Pay the required amount and then we will ship the books to you."
    },{
        id:"general_2",
		question: "I'm having trouble signing in, what can I do?",
        answer: "If you are having sign in ( login ) trouble and it is telling you your username, or password is incorrect, please use the Forgot my Username or Forgot my Password links on the Member Sign In page. If it says your system is blocking cookies, please follow the instructions on that page. If you experience any other sign in problem, please use our support form and describe exactly what happens after you click on the Sign In button."
    }, {
		id:"general_3",
        question: 'How many books can I order at a time?',
        answer: 'One user can only order two books at a time and you have to wait till we deliver those books to you first.'
    
	},{
		id:"general_4",
        question: 'How many books do I return at a time?',
        answer: 'You need to return book individually as each book might have individual last date.'
    
	},{
		id:"general_5",
        question: 'What if I am not able to return book on time?',
        answer: 'You will be charged Rs10 per book per day till 2 weeks after that the book will not be accepted in any condition.'
    
	},{
		id:"general_6",
        question: 'What are the delivery and pickup locations?',
        answer: 'Currently, We deliver only in Noida and Ghaziabad. We will soon expand to your place.'
    
	},{
		id:"general_7",
        question: 'How do I contact you?',
        answer: 'The best method to contact us is by email i.e. help@odekh.com.'
    
	}];
	
	$scope.faqs_membership=[
    {
        id:"membership_1",
		question:'How does membership work?',
        answer:"After signing up, Choose the suitable plan and pay for it. After that just browse the Web site and add titles to your cart by clicking the Add to Cart button. We automatically ship the number of titles your membership plan allows. You may keep the book(s) as long as you'd like till you are an active member, there are no due dates or late fees. When we recieve your order back then we automatically generate and ship your next order."
    },{
        id:"membership_2",
		question: "How long can I keep books?",
        answer: "You can keep books as long as you like and you being an active member of some membership plan."
    }, {
        id:"membership_3",
        question: 'How many books do I return at a time?',
        answer: 'Book members are required to return the same number they receive in each order. We do allow members to send back different titles from different orders. If book members fail to return the correct number of titles, there will be a delay until the correct number is received.'
    }, {
        id:"membership_4",
        question: 'What if my membership expired and I have some books?',
        answer: 'You will be charged ₹10 per book per day and if book is not returned or membership is not renewed within two weeks. No more books will be accepted.'
    }];

	$scope.faqs_myaccount=[
      {
		  id:"myaccount_1",
          question:'What is Cart?',
          answer:"A Cart is a virtual shopping box that shows the details of all the books that the user is ready to rent in the present order. The user freezes the books in the Rental Cart and then proceeds for providing the delivery information and payment to confirm order."
      },{
		  id:"myaccount_2",
          question:"How do I add books to Cart?",
          answer: "Click on the 'Add to cart' button on the books. These books get added to your Bookshelf. You can select the books you want to rent presently and add them to your rental cart and proceed with the checkout when you are ready to confirm the order."
      }];
	
	$scope.faqs_delivery=[
    {
        id:"delivery_1",
		question:'How does the pick-up work ?',
		answer:"You don't have to worry about the pick-up. When you place a request for pick up via email, ODekh's representative / our logistics partner will pick-up the packet from your given address."
    },{
        id:"delivery_2",
		question: "How do I pack the books to be returned ?",
        answer: "Just give it directly to our representative."
    }, {
        id:"delivery_3",
        question: "What if I lose or damage ODekh.com's books ?",
        answer: 'Please inform us at help@odekh.com. There will be no refund applicable upon loss or damage of book and it will be assumed to be sold to you.'
    },{
		 id:"delivery_4",
        question: "When do I receive my delivery after I put a rental request ?",
        answer: 'We try our best to provide the fastest door-step delivery. You will receive your delivery within 2 working days. If you stay in NCR region.'
	},{
		 id:"delivery_5",
        question: "Who collects and delivers my books ?",
        answer: 'Once you request the delivery/pick-up of books on the portal we take care of the rest.'
	},{
		 id:"delivery_6",
        question: "What all locations does ODekh deliver books ?",
        answer: 'We deliver only to NOIDA and Ghaziabad only.'
	}];
	
	$scope.faqs_payment=[
    {
        id:"payment_1",
		question:'How do I pay for ODekh.com transactions?',
        answer:"You can pay online with your debit card, credit card, net-banking and wallets only."
    },{
        id:"payment_2",
		question: "Are there any hidden charges when I order at ODekh.com ?",
        answer: "No taxes or additional charges apart from those mentioned on the website shall be charged."
    }, {
        id:"payment_3",
        question: 'Is it safe to use credit card / debit card on ODekh.com ?',
        answer: 'Yes.It is safe to use all payment options on ODekh.com.'
    },{
		id:"payment_4",
        question: 'How do I use Internet Banking to pay on ODekh.com ?',
        answer: 'Please select the Internet Banking option and the bank you want to transact via and you will be directed to the internet banking portal of the Bank. Once you have made the payment, you will be redirected to Odekh website for order confirmation.',
	},{
		id:"payment_5",
        question: 'How do I place a cash-on-delivery order ?',
        answer: 'Sorry, but we donot have Cash-on-delivery option.'
	},{
		id:"payment_6",
        question: 'Does ODekh.com provide Cash-on-Delivery ?',
        answer: 'NO, but we donot have Cash-on-delivery option.'
	}];
});


