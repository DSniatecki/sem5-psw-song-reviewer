package de.fred4jupiter.spring.boot.jsf.model;

public class Review {
    private Integer id;
    private String song;
    private String album;
    private String artist;
    private String review;
    private Integer score;
    private String recommendationType;
    private Reviewer reviewer;

    public Review() {
    }

    public Review(Integer id, String song, String album, String artist, String review, Integer score, String recommendationType, Reviewer reviewer) {
        this.id = id;
        this.song = song;
        this.album = album;
        this.artist = artist;
        this.review = review;
        this.score = score;
        this.recommendationType = recommendationType;
        this.reviewer = reviewer;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
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

    public Reviewer getReviewer() {
        return reviewer;
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

    public void setReviewer(Reviewer reviewer) {
        this.reviewer = reviewer;
    }

    public Integer getScore() {
        return score;
    }
}
