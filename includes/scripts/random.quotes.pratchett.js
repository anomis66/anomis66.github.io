
function get_random(maxNum)
{
  if (Math.random && Math.round)
  {
    var ranNum= Math.round(Math.random()*(maxNum-1));
    ranNum+=1;
    return ranNum;
  }
  else
  {
  today= new Date();
  hours= today.getHours();
  mins=   today.getMinutes();
  secn=  today.getSeconds();
  if (hours==19)
   hours=18;
  var ranNum= (((hours+1)*(mins+1)*secn)%maxNum)+1;
  return ranNum;
  }
}

function getaQuote()
{
 var maxQuotes=15;
 var whichQuote=get_random(maxQuotes);
 whichQuote--;

var quote=new Array(maxQuotes)

	quote[0]="Only in our dreams are we free. The rest of the time we need wages.";
	quote[1]="This isn\'t life in the fast lane, it\'s life in the oncoming traffic.";
	quote[2]="The pen is mightier than the sword if the sword is very short, and the pen is very sharp.";
	quote[3]="It\'s not worth doing something unless you were doing something that someone, somewhere, would much rather you weren't doing.";
	quote[4]="Light thinks it travels faster than anything but it is wrong. No matter how fast light travels, it finds the darkness has always got there first, and is waiting for it.";
	quote[5]="Give a man a fire and he\'s warm for the day, but set fire to him and he\'s warm for the rest of his life.";
	quote[6]="It is said that your life flashes before your eyes just before you die. That is true, it\'s called Life.";
	quote[7]="Wisdom comes from experience. Experience is often a result of lack of wisdom.";
	quote[8]="Always be wary of any helpful item that weighs less than it\'s operating manual.";
	quote[9]="The duke had a mind that ticked like a clock and, like a clock, it regularly went cuckoo.";
	quote[10]="A marriage is always made up of two people who are prepared to swear that only the other one snores.";
	quote[11]="...inside every old person is a young person wondering what happened.";
	quote[12]="Just because someone's a member of an ethnic minority doesn't mean they're not a nasty small-minded little jerk.";
	quote[13]="The trouble with having an open mind, of course, is that people will insist on coming along and trying to put things in it.";
	quote[14]="Stories of imagination tend to upset those without one.";

document.write("<div class=\"small center\"><q>"+quote[whichQuote]+"</q><strong> - Sir Terry Pratchett OBE</strong></div>");

}

getaQuote();

