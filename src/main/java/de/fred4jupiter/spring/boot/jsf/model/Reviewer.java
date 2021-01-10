package de.fred4jupiter.spring.boot.jsf.model;

public class Reviewer {
    private Integer id;
    private String login;
    private String email;
    private String password;
    private boolean isFemale;

    public Reviewer() {
    }

    public Reviewer(Integer id, String login, String email, String password, boolean isFemale) {
        this.id = id;
        this.login = login;
        this.email = email;
        this.password = password;
        this.isFemale = isFemale;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getLogin() {
        return login;
    }

    public void setLogin(String login) {
        this.login = login;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public boolean isFemale() {
        return isFemale;
    }

    public void setFemale(boolean female) {
        isFemale = female;
    }

}
