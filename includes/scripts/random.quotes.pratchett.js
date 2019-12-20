var quotes = new Array(
	"'And what would humans be without love?' RARE, said Death.", "Terry Pratchett, Sorcery",
	"A lie can run round the world before the truth has got its boots on.", "Terry Pratchett",
	"Before you judge a man, walk a mile in his shoes. After that who cares? He's a mile away and you've got his shoes!","Billy Connolly",
	"A marriage is always made up of two people who are prepared to swear that only the other one snores.", "Terry Pratchett, The Fifth Elephant",
	"Always be wary of any helpful item that weighs less than its operating manual.", "Terry Pratchett, Jingo",
	"Avoid people who say they know the answer. Keep the company of people who are trying to understand the question.", "Billy Connolly",
	"Coming back to where you started is not the same as never leaving.", "Terry Pratchett",
	"Don't put your trust in revolutions. They always come around again. That's why they're called revolutions.", "Terry Pratchett, Night Watch",
	"Life is supposed to be fun. It's not a job or occupation. We're here only once and we should have a bit of a laugh.","Billy Connolly",
	"Erotic vs Kinky: It's the difference between using a feather and using a chicken.", "Terry Pratchett",
	"Evil begins when you begin to treat people as things.", "Terry Pratchett",
	"I think age is terribly over-rated. You're okay as long as you don't grow up. By all means grow old, but don't mature. Remain childlike, retain wonder, the ability to be flabbergasted by something.","Billy Connolly",
	"Fantasy is an exercise bicycle for the mind. It might not take you anywhere, but it tones up the muscles that can.", "Terry Pratchett",
	"For animals, the entire universe has been neatly divided into things to (a) mate with, (b) eat, (c) run away from, and (d) rocks.", "Terry Pratchett, Equal Rites",
	"Never trust a man, who when left alone with a tea cosey ... Doesn't try it on.","Billy Connolly",
	"Give a man a fire and he's warm for the day. But set fire to him and he's warm for the rest of his life", "Terry Pratchett",
	"I'll be more enthusiastic about encouraging thinking outside the box when there's evidence of any thinking going on inside it.", "Terry Pratchett",
	"The desire to be a politician should bar you for life from ever becoming one.  Don't vote. It just encourages them....","Billy Connolly",
	"If you trust in yourself ... and believe in your dreams ... and follow your star ... you'll still get beaten by people who spent their time working hard and learning things and weren't so lazy", "Terry Pratchett, The Wee Free Men",
	"In ancient times cats were worshiped as gods; they have not forgotten this.", "Terry Pratchett",
	"There's no such thing as bad weather - only the wrong clothes.","Billy Connolly",
	"In the beginning there was nothing, and it exploded.", "Terry Pratchett",
	"Inside every sane person there's a madman struggling to get out.", "Terry Pratchett",
	"A well-balanced person has a drink in each hand.","Billy Connolly",
	"My definition of an intellectual is someone who can listen to the William Tell Overture without thinking of the Lone Ranger.","Billy Connolly",
	"It is said that your life flashes before your eyes just before you die. That is true, it's called Life.", "Terry Pratchett",
	"When people say &quot;it's always the last place you look. &quot;Of course it is. Why would you keep looking after you've found it?","Billy Connolly",
	"And then there was my mate who'd just been fitted with a brand new hearing aid. &quot;It's the best in the world&quot;, he said. &quot;What type is it?&quot; , I asked and he said  &quot;ten past twelve&quot; .","Billy Connolly",
	"It's not worth doing something unless someone, somewhere, would much rather you weren't doing it.", "Terry Pratchett",
	"Light thinks it travels faster than anything but it is wrong.  No matter how fast light travels, it finds darkness has always got there first, and is waiting for it.", "Terry Pratchett",
	"So, have you heard about the oyster who went to a disco and pulled a mussel?","Billy Connolly",
	"Most gods throw dice, but Fate plays chess, and you don't find out till too late that they've been playing with two queens all along.", "Terry Pratchett",
	"No one is actually dead until the ripples they cause in the world die away.", "Terry Pratchett",
	"I've always wanted to go to Switzerland to see what the army does with those wee red knives.","Billy Connolly",
	"Of course I'm sane, when trees start talking to me, I don't talk back.", "Terry Pratchett",
	"Only in our dreams are we free. The rest of the time we need wages.", "Terry Pratchett",
	"I've always wanted to go to Switzerland to see what the army does with those wee red knives.","Billy Connolly",
	"Real stupidity beats artificial intelligence every time", "Terry Pratchett",
	"Scientists have calculated that the chances of something so patently absurd actually existing are millions to one.  But magicians have calculated that million-to-one chance crop up nine times out of ten.", "Terry Pratchett",
	"A woman's mind is as complex as the contents of her handbag; even when you get to the bottom of it, there is ALWAYS something at the bottom to surprise you!","Billy Connolly",
	"Sometimes it's better to light a flamethrower than to curse the darkness.", "Terry Pratchett",
	"Steal five pounds and you're a common thief.  Steal thousands and you're either the government or a hero.", "Terry Pratchett",
	"I worry about ridiculous things, you know, how does a guy who drives a snowplough get to work in the morning. ... That can keep me awake for days.","Billy Connolly",
	"Stories of imagination tend to upset those without one.", "Terry Pratchett",
	"The duke had a mind that ticked like a clock and, like a clock, it regularly went cuckoo.", "Terry Pratchett, Wyrd Sisters",
	"The trouble with having an open mind, of course, is that people will insist on coming along and trying to put things in it.", "Terry Pratchett",
	"The whole of life is just like watching a film.  Only it's as though you always get in ten minutes after the big picture has started, and no-one will tell you the plot, so you have to work it out all yourself from the clues.", "Terry Pratchett",
	"There are times in life when people must know when not to let go. Balloons are designed to teach small children this.", "Terry Pratchett",
	"They say a little knowledge is a dangerous thing, but it's not one half so bad as a lot of ignorance.", "Terry Pratchett",
	"Time is a drug. Too much of it kills you.", "Terry Pratchett",
	"Two types of people laugh at the law: those that break it and those that make it.", "Terry Pratchett, Night Watch",
	"Wisdom comes from experience.  Experience is often a result of a lack of wisdom.", "Terry Pratchett"
);

// ----- get $total number of $quotes - divide by / 2 because each $quote is followed by the $author -----
var total = (quotes.length / 2); 

// ----- $total as array starts at [0]-----
var count = Math.ceil( Math.random() * total );

// ----- odds/evens -----
var q_count = (count * 2);

// ----- get $quote form $quotes -----
var quote = quotes[q_count];
	q_count++;

var author = quotes[q_count];

document.getElementById("quoted_by").innerHTML = '<q>' + quote + '</q><cite>' + author + '</cite>';
