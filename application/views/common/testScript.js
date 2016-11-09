function dateFunction()
{

var Person = function(firstName) {
this.firstName = firstName;
console.log('Person Instantiated');
};


var person1 = new Person('Alice');
var person2 = new Person('Bob');
var helloFunction = person1.sayHello;

Person.prototype.sayHello = function()
{

console.log("Hello, I'm " + this.firstName);



}






person1.sayHello();
person2.sayHello();

helloFunction();

console.log(helloFunction === person1.sayHello);

console.log(helloFunction === Person.prototype.sayHello);

helloFunction.call(person1);

//console.log('person1 is ' + person1.firstName);
//console.log('person2 is ' + person2.firstName);


document.getElementById('demo').innerHTML = Date();

}