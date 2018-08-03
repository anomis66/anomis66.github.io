var quotes = new Array(
	"'And what would humans be without love?' RARE, said Death.", "Terry Pratchett, Sorcery",
	"A lie can run round the world before the truth has got its boots on.", "Terry Pratchett",
	"A marriage is always made up of two people who are prepared to swear that only the other one snores.", "Terry Pratchett, The Fifth Elephant",
	"Always be wary of any helpful item that weighs less than its operating manual.", "Terry Pratchett, Jingo",
	"Coming back to where you started is not the same as never leaving.", "Terry Pratchett",
	"Don't put your trust in revolutions. They always come around again. That's why they're called revolutions.", "Terry Pratchett, Night Watch",
	"Erotic vs Kinky: It's the difference between using a feather and using a chicken.", "Terry Pratchett",
	"Evil begins when you begin to treat people as things.", "Terry Pratchett",
	"Fantasy is an exercise bicycle for the mind. It might not take you anywhere, but it tones up the muscles that can.", "Terry Pratchett",
	"For animals, the entire universe has been neatly divided into things to (a) mate with, (b) eat, (c) run away from, and (d) rocks.", "Terry Pratchett, Equal Rites",
	"Give a man a fire and he's warm for the day. But set fire to him and he's warm for the rest of his life", "Terry Pratchett",
	"I'll be more enthusiastic about encouraging thinking outside the box when there's evidence of any thinking going on inside it.", "Terry Pratchett",
	"If you trust in yourself ... and believe in your dreams ... and follow your star ... you'll still get beaten by people who spent their time working hard and learning things and weren't so lazy", "Terry Pratchett, The Wee Free Men",
	"In ancient times cats were worshiped as gods; they have not forgotten this.", "Terry Pratchett",
	"In the beginning there was nothing, and it exploded.", "Terry Pratchett",
	"Inside every sane person there's a madman struggling to get out.", "Terry Pratchett",
	"It is said that your life flashes before your eyes just before you die. That is true, it's called Life.", "Terry Pratchett",
	"It's not worth doing something unless someone, somewhere, would much rather you weren't doing it.", "Terry Pratchett",
	"Light thinks it travels faster than anything but it is wrong.  No matter how fast light travels, it finds darkness has always got there first, and is waiting for it.", "Terry Pratchett",
	"Most gods throw dice, but Fate plays chess, and you don't find out till too late that they've been playing with two queens all along.", "Terry Pratchett",
	"No one is actually dead until the ripples they cause in the world die away.", "Terry Pratchett",
	"Of course I'm sane, when trees start talking to me, I don't talk back.", "Terry Pratchett",
	"Only in our dreams are we free. The rest of the time we need wages.", "Terry Pratchett",
	"Real stupidity beats artificial intelligence every time", "Terry Pratchett",
	"Scientists have calculated that the chances of something so patently absurd actually existing are millions to one.  But magicians have calculated that million-to-one chance crop up nine times out of ten.", "Terry Pratchett",
	"Sometimes it's better to light a flamethrower than to curse the darkness.", "Terry Pratchett",
	"Steal five pounds and you're a common thief.  Steal thousands and you're either the government or a hero.", "Terry Pratchett",
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

// ----- get $total number of $quotes - divide by /2 because each $quote is followed by an $author -----
var total = (quotes.length/2);
// ----- $total-1 as array starts at [0]-----
var count = Math.floor((Math.random() * total) + 1);;
// ----- odds/evens -----
count = count * 2;
// ----- get $quote form $quotes -----
var quote = quotes[count];
			count++;
var author = quotes[count];

document.getElementById("quoted_by").innerHTML = '<span><q>' + quote + '</q> - <em>' + author + '</em></span>';
