package de.fred4jupiter.spring.boot.jsf.bean;

import de.fred4jupiter.spring.boot.jsf.model.Review;
import de.fred4jupiter.spring.boot.jsf.scope.ScopeName;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import javax.faces.application.FacesMessage;
import javax.faces.context.FacesContext;
import java.io.IOException;
import java.io.Serializable;
import java.util.Random;

@Component
@Scope(ScopeName.VIEW)
public class NewReview implements Serializable {

    private static final long serialVersionUID = 1715935052239888761L;

    private String song;
    private String album;
    private String artist;
    private Integer score;
    private String recommendationType;
    private String review;

    public void addBean() {
        Random ran = new Random();
        ReviewsBean.reviews.add(
                new Review(
                        ran.nextInt(Integer.MAX_VALUE),
                        song,
                        album,
                        artist,
                        review,
                        score,
                        recommendationType,
                        ReviewsBean.reviewer1
                )
        );
        song = null;
        album = null;
        artist = null;
        review = null;
        score = null;
        FacesContext.getCurrentInstance().addMessage(FacesMessage.SEVERITY_INFO.toString(), new FacesMessage("Your review was added!"));
    }

    public NewReview() {
    }

    public NewReview(String song, String album, String artist, Integer score, String recommendationType, String review) {
        this.song = song;
        this.album = album;
        this.artist = artist;
        this.score = score;
        this.recommendationType = recommendationType;
        this.review = review;
    }

    public String getSong() {
        return song;
    }

    public void setSong(String song) {
        this.song = song;
    }

    public String getAlbum() {
        return album;
    }

    public void setAlbum(String album) {
        this.album = album;
    }

    public String getArtist() {
        return artist;
    }

    public void setArtist(String artist) {
        this.artist = artist;
    }

    public String getReview() {
        return review;
    }

    public void setReview(String review) {
        this.review = review;
    }

    public Integer getScore() {
        return score;
    }

    public void setScore(Integer score) {
        this.score = score;
    }

    public String getRecommendationType() {
        return recommendationType;
    }

    public void setRecommendationType(String recommendationType) {
        this.recommendationType = recommendationType;
    }

}
