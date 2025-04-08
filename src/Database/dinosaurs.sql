-- Create the database
CREATE DATABASE IF NOT EXISTS iwiessle;
USE iwiessle;

-- Create the table
CREATE TABLE IF NOT EXISTS dino_catalogue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    short_description VARCHAR(255) NOT NULL,
    long_description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_address VARCHAR(255) NOT NULL,
    status ENUM('available', 'unavailable') NOT NULL,
    tags TEXT NOT NULL
);

-- Insert data
INSERT INTO dino_catalogue (name, short_description, long_description, price, image_address, status, tags) VALUES
('Tyrannosaurus rex', 'The king of the dinosaurs, known for its massive size and powerful bite.', 
'Despite its fearsome reputation, the Tyrannosaurus rex can be a fiercely loyal companion when properly trained. This apex predator is highly intelligent, capable of following complex commands, and can serve as an imposing bodyguard. With its keen senses, the T. rex can detect intruders from miles away, making it the perfect guardian. It can be trained to roar on command to scare away potential threats or assist in large-scale security operations. Surprisingly, it forms strong bonds with its handlers and is known to respond positively to rewards-based training.', 
9999.99, 'assets/tyrannosaurus-rex-shop.jpg', 'available', 'smart, guard dino, protection, companion'),

('Triceratops', 'A three-horned herbivore with a large frill.', 
'The Triceratops is a powerhouse of strength and endurance, making it the perfect companion for heavy lifting, transport, and other work-heavy duties. With its three powerful horns and protective frill, it is a natural guardian that can deter threats simply by its presence. Well-trained Triceratops are known to be gentle and highly obedient, making them ideal for companionship. Their sturdy build allows them to carry supplies over rough terrain, and they can be used for plowing fields, pulling carts.', 
20000.00, 'assets/triceratops-shop.jpg', 'available', 'herbivore, farm dino, gentle, working dino'),

('Velociraptor', 'A small, fast, and intelligent predator.', 
'Highly intelligent and agile, the Velociraptor is an excellent companion for scouting, hunting, and security operations. Trained Velociraptors are quick learners and can execute complex commands with remarkable precision. Their compact size and incredible speed allow them to navigate through challenging environments, making them ideal for search-and-rescue missions. With their loyalty and pack mentality, they work exceptionally well in coordinated teams, making them perfect for tasks that require teamwork and strategic execution. Despite their reputation, they can form deep bonds with their handlers and are excellent for stealth-based operations.', 
15000.00, 'assets/velociraptor-shop.jpg', 'available', 'fast, smart, search and rescue, guard dino, scout dino'),

('Stegosaurus', 'Famous for its back plates and spiked tail.', 
'The Stegosaurus is a well-armored, reliable service dinosaur that can act as a defensive companion. Its large, plate-covered back provides excellent protection, and its powerful spiked tail can deter any threat. A trained Stegosaurus is patient, resilient, and obedient, making it an excellent choice for carrying goods across difficult terrain. It is particularly useful for clearing paths through dense vegetation or serving as a mobile shield in dangerous areas. While not the fastest, its ability to endure long treks makes it a highly dependable asset for those who need a steady, trustworthy companion.', 
6000.00, 'assets/stegosaurus-shop.jpg', 'available', 'guard dino, working dino, herbivore, companion'),

('Brachiosaurus', 'A towering, long-necked herbivore.', 
'The gentle giant of the dinosaur world, the Brachiosaurus is an invaluable service dinosaur for reaching high places, clearing paths, and carrying heavy loads. Its incredible height allows it to assist in retrieving objects from tall structures or scouting vast landscapes. A well-trained Brachiosaurus is remarkably gentle and can be used for agricultural work, forestry management, and even as a moving observation tower. Its sheer presence is enough to deter most threats, and despite its size, it is known to be patient and kind with its handlers, making it a truly majestic companion.', 
120000.00, 'assets/brachiosaurus-shop.jpg', 'available', 'mobility, working dino, gentle, herbivore'),

('Spinosaurus', 'A massive, sail-backed predator, possibly semi-aquatic.', 
'The Spinosaurus is an unmatched service dinosaur for water-based operations. With its semi-aquatic nature, it excels in tasks such as fishing, marine patrol, and water rescue missions. Its massive size and powerful jaws make it a formidable guard, while its affinity for water allows it to transport goods across rivers and lakes with ease. A well-trained Spinosaurus is highly effective in amphibious operations and can transition seamlessly between land and water. Despite its intimidating nature, it can form strong bonds with trainers and become an incredibly useful aquatic companion.', 
25000.00, 'assets/spinosaurus-shop.jpg', 'available', 'search and rescue, aquatic, working dino'),

('Allosaurus', 'A fierce predator, often compared to T. rex but lived earlier.', 
'The Allosaurus is a swift and intelligent hunter, making it a perfect service dinosaur for tracking, search-and-rescue, and defense. With its strong legs and sharp senses, it is highly effective at patrolling large areas and quickly responding to threats. Trained Allosaurs are known to be fiercely loyal and can work well in coordination with handlers. Whether guarding territories, assisting in law enforcement, or working as a high-speed scout, the Allosaurus is a formidable yet trainable companion that excels in dynamic environments.', 
10000.00, 'assets/allosaurus-shop.jpg', 'available', 'working dino, scout dino, search and rescue, guard dino, protection'),

('Ankylosaurus', 'A heavily armored herbivore with a club-like tail.', 
'The Ankylosaurus is the ultimate defensive dinosaur. With its heavily armored body and clubbed tail, it is perfect for guarding areas and shielding allies from danger. A well-trained Ankylosaurus is calm and steadfast, making it an ideal service dinosaur for protection and construction. It can be used to clear debris, knock down barriers, and even assist in crowd control. Despite its heavy armor, it is known to be surprisingly gentle with its handlers and can be relied upon as a dependable guardian in any situation.', 
12000.00, 'assets/ankylosaurus-shop.jpg', 'available', 'gentle, herbivore, guard dino, protection, companion'),

('Pteranodon', 'A famous flying reptile (technically not a dinosaur, but often grouped with them).', 
'The Pteranodon is a remarkable flying companion, ideal for aerial surveillance, message delivery, and reconnaissance missions. With its vast wingspan and ability to glide effortlessly through the sky, it provides an excellent advantage in spotting threats from above. A trained Pteranodon can carry small cargo, transport urgent messages, and assist in rescue operations by scouting large areas. Its intelligence and speed make it an invaluable airborne asset for anyone needing a highly mobile, flying companion.', 
15000.00, 'assets/pteranodon-shop.jpg', 'available', 'flying, scout dino, search and rescue, mobility, messenger dino'),

('Parasaurolophus', 'A duck-billed dinosaur with a long, curved crest.', 
'The Parasaurolophus is an excellent service dinosaur for communication and companionship. Its unique crest can produce a variety of sounds, making it perfect for signaling, alerting, and even musical performances. Highly social and trainable, it thrives in group settings and can assist in herding, security, and cooperative tasks. With its friendly nature and distinctive vocal abilities, it is an engaging and useful addition to any team.', 
15000.00, 'assets/parasaurolophus-shop.jpg', 'available', 'herbivore, gentle, companion, guard dino, messenger dino'),

('Iguanodon', 'One of the first dinosaurs ever discovered, known for its thumb spikes.', 
'The Iguanodon is a strong and versatile herbivore known for its unique thumb spikes, which can be used for defense and utility. It is well-suited for agricultural tasks, pulling carts, and serving as a reliable pack dinosaur. With its intelligence and cooperative nature, it can be trained for a variety of tasks, including guarding livestock, carrying supplies, and even assisting in rescue missions.', 
25000.00, 'assets/iguanodon-shop.jpg', 'available', 'herbivore, working dino, farm dino, guard dino, protection, companion');

INSERT INTO dino_catalogue (name, short_description, long_description, price, image_address, status, tags) VALUES
('Carnotaurus', 'A unique predator with short horns above its eyes and tiny arms.', 
'The Carnotaurus is a swift and powerful predator, perfect for high-speed pursuits and security roles. With its strong legs, it can cover vast distances quickly, making it excellent for patrolling and hunting tasks. Its distinctive horns provide extra protection during combat, while its keen senses allow it to detect intruders with ease. Though its arms are small, its powerful jaws more than make up for any shortcomings. A well-trained Carnotaurus is both obedient and fiercely loyal, making it a perfect service dinosaur for scouting, guarding, and even participating in high-speed chase operations.', 
22000.00, 'assets/carnotaurus-shop.jpg', 'available', 'fast, guard dino, hunting dino'),

('Diplodocus', 'A long-necked herbivore, one of the longest dinosaurs.', 
'The Diplodocus is an incredible service dinosaur for large-scale agricultural, construction, and exploration tasks. With its exceptionally long neck, it can reach high places with ease, making it perfect for retrieving objects, trimming tall trees, and assisting in forestry work. Its calm nature and immense size make it an ideal pack dinosaur, capable of carrying heavy loads across great distances. Despite its massive frame, a well-trained Diplodocus is gentle, cooperative, and highly obedient, making it a valuable asset for anyone needing a reliable, long-range worker and companion.', 
25000.00, 'assets/diplodocus-shop.jpg', 'available', 'working dino, herbivore, gentle, farm dino, mobility'),

('Megalosaurus', 'The first dinosaur ever named scientifically.', 
'Megalosaurus is a historic and formidable predator, known for its strong build and sharp senses. As the first dinosaur to be named scientifically, it carries a legacy of power and adaptability. Well-trained Megalosaurs are exceptional for tracking, patrolling, and high-intensity security work. Their intelligence allows them to follow advanced commands, making them valuable allies in strategic operations. With their keen hunting instincts, they excel in search-and-rescue missions, quickly locating targets in challenging terrains. Their balanced agility and strength make them reliable, responsive service dinosaurs with a deep-rooted history in paleontology and discovery.', 
18000.00, 'assets/megalosaurus-shop.jpg', 'available', 'smart, search and rescue, hunting dino, working dino');
