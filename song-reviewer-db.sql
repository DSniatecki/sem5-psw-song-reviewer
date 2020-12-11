DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS reviewers;

CREATE TABLE reviewers
(
    id        SERIAL PRIMARY KEY,
    login     VARCHAR(40) NOT NULL UNIQUE,
    email     VARCHAR(40) NOT NULL UNIQUE,
    password  VARCHAR(80) NOT NULL,
    is_female BOOLEAN     NOT NULL
);

CREATE TABLE reviews
(
    id          SERIAL,
    song        VARCHAR(120)  NOT NULL,
    artist      VARCHAR(80)   NOT NULL,
    album       VARCHAR(80),
    review      VARCHAR(1000) NOT NULL,
    reviewer_id INT,
    CONSTRAINT fk_reviewer FOREIGN KEY (reviewer_id) REFERENCES reviewers (id)
);


INSERT INTO reviewers(login, email, password, is_female)
VALUES ('Bartek', 'bartek@gmail.com', 'bartek', false),
       ('Agnieszka', 'agnieszka@gmail.com', 'agnieszka', true);


INSERT INTO reviews(song, artist, album, review, reviewer_id)
VALUES ('505', 'Arctic Monkeys', 'Favourite Worst Nightmare',
        'Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am - dram theatricality, can’t help but be a real rock star even as he plays with the role . In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine ?, a diamond anthem that tightens and collapses at all the right moments . Now armed with what is essentially a greatest - hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real',
        1),
       ('Do I wanna know', 'Arctic Monkeys', 'AM',
        'The band, bolstered by supporting players on keys and acoustic guitar, are immaculately drilled – sometimes too much so, as on Pretty Visitors, which hops around with math - rock fussiness, or She Looks Like Fun, which looks tremendously enjoyable for Cook but will surely not hang around their setlist for long . Much better is when their chops are transmuted into pure energy: Brianstorm, Don’t Sit Down ’Cause I’ve Moved Your Chair and View from the Afternoon swerve too fast through their corners and are all the better for it . The drummer Matt Helders, a mere timekeeper during the Tranquility Base material, is transformed into a dynamo; with a spotlight behind him, he becomes a tub - thumping Godzilla on the rear wall .',
        2),
       ('Fluorescent Adolescent', 'Arctic Monkeys', 'Favourite Worst Nightmare',
        'Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am - dram theatricality, can’t help but be a real rock star even as he plays with the role . In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine ?, a diamond anthem that tightens and collapses at all the right moments . Now armed with what is essentially a greatest - hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real',
        1),
       ('Castle of glass', 'Linkin Park', 'Hybrid Theory',
        'Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am - dram theatricality, can’t help but be a real rock star even as he plays with the role . In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine ?, a diamond anthem that tightens and collapses at all the right moments . Now armed with what is essentially a greatest - hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real',
        1),
       ('Numb', 'Linkin Park', 'Hybrid Theory',
        'In May of 2019, an anonymous outfit known only as SAULT released an album of tasteful soul - funk with a scratchy DIY veneer that sounded like an Instagram - filtered reunion of ESG . Biography - shy musicians that bring a retro sensibility to the music of late - 1970s, early - ’80s roller rinks and B - boys aren’t unusual, from the action - packed exuberance of the Go!Team in the 2000s to the falsetto - streaked brooding of Jungle in the last decade . SAULT, though, were unusually prolific, and they had something to say . With lyrics foregrounding Black identity, June’s UNTITLED(Black Is) seemed like a fitting soundtrack for this summer of collective action against police violence and systemic racism.',
        2),
       ('Lose yourself', 'Eminem', 'The Eminem Show',
        'The band, bolstered by supporting players on keys and acoustic guitar, are immaculately drilled – sometimes too much so, as on Pretty Visitors, which hops around with math - rock fussiness, or She Looks Like Fun, which looks tremendously enjoyable for Cook but will surely not hang around their setlist for long . Much better is when their chops are transmuted into pure energy: Brianstorm, Don’t Sit Down ’Cause I’ve Moved Your Chair and View from the Afternoon swerve too fast through their corners and are all the better for it . The drummer Matt Helders, a mere timekeeper during the Tranquility Base material, is transformed into a dynamo; with a spotlight behind him, he becomes a tub - thumping Godzilla on the rear wall .',
        2);