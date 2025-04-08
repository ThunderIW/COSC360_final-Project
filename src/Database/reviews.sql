use iwiessle;

-- Create table reviews
CREATE TABLE reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    dino_id INT NOT NULL,
    text VARCHAR(500) NOT NULL,
    name VARCHAR(30) NOT NULL
);

-- Insert sample data
INSERT INTO reviews (user_id, dino_id, text, name) VALUES
(-18, 14, "Great dino to have, but you better have energy to run around half the town with this energetic beast.", "Frode Ridna"),
(-17, 14, "Paramedic here, the Megalo's a great dino to track lost children and travel almost any rough terrain.", "Esty Léonhart"),
(-19, 13, "I remember when my Pops had one of them. Great around the farm, and super gentle with me. RIP Tommy.", "Flint Carmintail"),
(-34, 10, "Been teaching him how to sing happy birthday, hope my gf likes it!", "Freid Black"),
(-28, 10, "Ah I see this is where you got the happy birthday singing dino. Imma get one of my own!", "Chio M"),
(-18, 9, "He can fly faster than I can! I feel my job as a messenger is being threatened!", "Frode Ridna"),
(-27, 8, "Great insurance against robberies and break ins. Just have a big enough yard for it.", "Mazrill Vike"),
(-10, 8, "My mom and I had one of these when I was younger to guard the house.", "Elizabeth Liebe"),
(-17, 7, "Best hunting buddy I ever had. Only downside is I need to split my game with her.", "Esty Léonhart"),
(-38, 7, "Grew up with these felas. Best dinos at all they do.", "Dahkroff"),
(-47, 6, "A dino who can keep up with me in the many rivers and oceans I go diving in!", "Leah Dohlson"),
(-61, 6, "Worst enemy of pirates and best friend of stranded sailors.", "Drake Ambell"),
(-10, 5, "Loves nature as much as I do, and treats all beings with great gentleness.", "Elizabeth Liebe"),
(-36, 5, "We use it around town to lug heavy stones and rocks across the land. Dead useful for miners and blacksmiths.", "Young Wolfey"),
(-17, 3, "Fantastic for catching prey and hunting, especially in the night.", "Esty Léonhart"),
(-33, 2, "Worked alongside one of these titans a few years ago while working construction. Beautiful creatures, super useful and despite their appearance, very calm and gentle. I've met more violent houseplants than Triceratopses.", "Larthunder Vike"),
(-34, 1, "Smart, strong and silent. Just hoping he'll eat my dumb roommate.", "Freid Black"),
(-19, 1, "I agree with the smart, strong and silent part of Freid's review. Only problem is the dumb buddy likes to poke its head through my bedroom window. Has shattered more glass than is in the rest of the house put together.", "November");
