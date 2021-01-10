package de.fred4jupiter.spring.boot.jsf.bean;

import de.fred4jupiter.spring.boot.jsf.model.Review;
import de.fred4jupiter.spring.boot.jsf.model.Reviewer;
import de.fred4jupiter.spring.boot.jsf.scope.ScopeName;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

@Component
@Scope(ScopeName.VIEW)
public class ReviewsBean {

    public static List<String> artists = Arrays.asList(
            "Arctic Monkeys",
            "Linkin Park",
            "Eminem"
    );

    public static Reviewer reviewer1 = new Reviewer(1312312, "Bartek", "bartek@gmail.com", "bartek", false);
    public static Reviewer reviewer2 = new Reviewer(2654342, "Agnieszka", "agnieszka@gmail.com", "agnieszka", true);

    public static List<Review> reviews = new ArrayList<Review>() {
        {
            add(new Review(545313, "505", "Favourite Worst Nightmare", "Arctic Monkeys", "Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am - dram theatricality, can’t help but be a real rock star even as he plays with the role . In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine ?, a diamond anthem that tightens and collapses at all the right moments . Now armed with what is essentially a greatest - hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real", 8, "Yes", reviewer1));
            add(new Review(991223, "Do I wanna know", "AM", "Arctic Monkeys", "The band, bolstered by supporting players on keys and acoustic guitar, are immaculately drilled – sometimes too much so, as on Pretty Visitors, which hops around with math - rock fussiness, or She Looks Like Fun, which looks tremendously enjoyable for Cook but will surely not hang around their setlist for long . Much better is when their chops are transmuted into pure energy: Brianstorm, Don’t Sit Down ’Cause I’ve Moved Your Chair and View from the Afternoon swerve too fast through their corners and are all the better for it . The drummer Matt Helders, a mere timekeeper during the Tranquility Base material, is transformed into a dynamo; with a spotlight behind him, he becomes a tub - thumping Godzilla on the rear wall.", 8, "Yes", reviewer2));
            add(new Review(132312, "Fluorescent Adolescent", "Favourite Worst Nightmare", "Arctic Monkeys", "Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am - dram theatricality, can’t help but be a real rock star even as he plays with the role . In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine ?, a diamond anthem that tightens and collapses at all the right moments . Now armed with what is essentially a greatest - hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real.", 6, "No", reviewer2));
            add(new Review(5211, "Castle of glass", "Hybrid Theory", "Linkin Park", "Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am - dram theatricality, can’t help but be a real rock star even as he plays with the role . In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine ?, a diamond anthem that tightens and collapses at all the right moments . Now armed with what is essentially a greatest - hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real", 7, "I don not know", reviewer2));
            add(new Review(732132, "Numb", "Hybrid Theory", "Linkin Park", "In May of 2019, an anonymous outfit known only as SAULT released an album of tasteful soul - funk with a scratchy DIY veneer that sounded like an Instagram - filtered reunion of ESG . Biography - shy musicians that bring a retro sensibility to the music of late - 1970s, early - ’80s roller rinks and B - boys aren’t unusual, from the action - packed exuberance of the Go!Team in the 2000s to the falsetto - streaked brooding of Jungle in the last decade . SAULT, though, were unusually prolific, and they had something to say . With lyrics foregrounding Black identity, June’s UNTITLED(Black Is) seemed like a fitting soundtrack for this summer of collective action against police violence and systemic racism.", 10, "Yes", reviewer1));
            add(new Review(432132, "Lose yourself", "The Eminem Show", "Eminem", "The band, bolstered by supporting players on keys and acoustic guitar, are immaculately drilled – sometimes too much so, as on Pretty Visitors, which hops around with math - rock fussiness, or She Looks Like Fun, which looks tremendously enjoyable for Cook but will surely not hang around their setlist for long . Much better is when their chops are transmuted into pure energy: Brianstorm, Don’t Sit Down ’Cause I’ve Moved Your Chair and View from the Afternoon swerve too fast through their corners and are all the better for it . The drummer Matt Helders, a mere timekeeper during the Tranquility Base material, is transformed into a dynamo; with a spotlight behind him, he becomes a tub - thumping Godzilla on the rear wall .", 6, "Not really", reviewer1));

        }
    };

    public List<Review> getReviews() {
        return reviews;
    }

    public List<String> getArtists() {
        return artists;
    }
}
