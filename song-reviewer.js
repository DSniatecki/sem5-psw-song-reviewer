const websiteSettings = {
    isSettingsSelectorOpen: false,
    reviewsColor: "#000000",
    reviewsFontSize: 16,
    reviewsOpacity: 97
}

const songReviews = [
    {
        "id": "123123213",
        "isYoutubePlayerOpen": false,
        "song": {
            "name": "505",
            "artist": "Arctic Monkeys",
            "youtubeUrl": "https://www.youtube.com/embed/MrmPDUvKyLs",
            "album": "Favourite Worst Nightmare",
        },
        "reviewer": {
            "nickname": "Bartek",
            "email": "bartek@gmail.com"
        },
        "review": "Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am-dram theatricality, can’t help but be a real rock star even as he plays with the role. In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine?, a diamond anthem that tightens and collapses at all the right moments. Now armed with what is essentially a greatest-hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real."
    },
    {
        "id": "12376445213",
        "isYoutubePlayerOpen": false,
        "song": {
            "name": "Do I wanna know",
            "artist": "Arctic Monkeys",
            "youtubeUrl": "https://www.youtube.com/embed/bpOSxM0rNPM",
            "album": "AM",
        },
        "reviewer": {
            "nickname": "Konrad",
            "email": "konrad-reviwer@gmail.com"
        },
        "review": "The band, bolstered by supporting players on keys and acoustic guitar, are immaculately drilled – sometimes too much so, as on Pretty Visitors, which hops around with math-rock fussiness, or She Looks Like Fun, which looks tremendously enjoyable for Cook but will surely not hang around their setlist for long.\n" +
            "\n" +
            "Much better is when their chops are transmuted into pure energy: Brianstorm, Don’t Sit Down ’Cause I’ve Moved Your Chair and View from the Afternoon swerve too fast through their corners and are all the better for it. The drummer Matt Helders, a mere timekeeper during the Tranquility Base material, is transformed into a dynamo; with a spotlight behind him, he becomes a tub-thumping Godzilla on the rear wall."
    },
    {
        "id": "27657653213",
        "isYoutubePlayerOpen": false,
        "song": {
            "album": "Hybrid Theory",
            "artist": "Linkin Park",
            "name": "Numb",
            "youtubeUrl": "https://www.youtube.com/embed/kXYiU_JCYtU"
        },
        "review": "In May of 2019, an anonymous outfit known only as SAULT released an album of tasteful soul-funk with a scratchy DIY veneer that sounded like an Instagram-filtered reunion of ESG. Biography-shy musicians that bring a retro sensibility to the music of late-1970s, early-’80s roller rinks and B-boys aren’t unusual, from the action-packed exuberance of the Go! Team in the 2000s to the falsetto-streaked brooding of Jungle in the last decade. SAULT, though, were unusually prolific, and they had something to say. With lyrics foregrounding Black identity, June’s UNTITLED (Black Is) seemed like a fitting soundtrack for this summer of collective action against police violence and systemic racism.",
        "reviewer": {
            "email": "reviwer2222@gmail.com",
            "nickname": "SuperReviewer"
        },
    },
    {
        "id": "12319923213",
        "isYoutubePlayerOpen": false,
        "song": {
            "album": "Hybrid Theory",
            "artist": "Linkin Park",
            "name": "Castle of glass",
            "youtubeUrl": "https://www.youtube.com/embed/ScNNfyq3d_w"
        },
        "review": "Wherever they turn, irony dissolves and Turner, acting out lyrics like “I lost my train of thought” or “she held me very tightly” with am-dram theatricality, can’t help but be a real rock star even as he plays with the role. In the end, every side to the band – funk troupe, garage punks, aloof posers, heartfelt songwriters – coheres on the closing R U Mine?, a diamond anthem that tightens and collapses at all the right moments. Now armed with what is essentially a greatest-hits set, Arctic Monkeys have become a band who can do everything – it might be a construct, but it feels so real.",
        "reviewer": {
            "email": "superbear@gmail.com",
            "nickname": "Bear123"
        },
    },
    {
        "id": "1777123213",
        "isYoutubePlayerOpen": false,
        "song": {
            "album": "Favourite Worst Nightmare",
            "artist": " Arctic Monkeys",
            "name": "Fluorescent Adolescent ",
            "youtubeUrl": "https://www.youtube.com/embed/ma9I9VBKPiw"
        },
        "review": "Great Song !!!",
        "reviewer": {
            "email": "awdas@gmail.com",
            "nickname": "Kowalkiewicz"
        },
    }
]

function loadWebsite() {
    document.getElementById("addNewReviewForm").addEventListener("submit", addNewReviewFromFromEvent)
    loadReviews();
}

function loadReviews() {
    const reviewDiv = document.createElement("div");
    for (const review of songReviews) {
        reviewDiv.append(createReviewElement(review))
    }
    document.getElementById("reviews").innerHTML = reviewDiv.textContent
    for (const review of songReviews) {
        document.getElementById(review.id).addEventListener("click", (e) => manageYoutubePlayer(review))
    }
}

function addNewReviewFromFromEvent(event) {
    const formElements = document.forms.namedItem("newReviewForm").elements;
    console.log(formElements)
    const newReview = {
        "id": formElements.namedItem("songYoutubeUrl").value +
            songReviews.length + formElements.namedItem("songName").value,
        "isYoutubePlayerOpen": false,
        "song": {
            "name": formElements.namedItem("songName").value,
            "artist": formElements.namedItem("artistName").value,
            "youtubeUrl": formElements.namedItem("songYoutubeUrl").value,
            "album": formElements.namedItem("albumName").value,
        },
        "reviewer": {
            "nickname": formElements.namedItem("reviewerNickname").value,
            "email": formElements.namedItem("reviewerEmail").value
        },
        "review": formElements.namedItem("review").value
    }
    event.preventDefault()
    event.target.reset()
    songReviews.push(newReview)
    loadReviews()
    console.log(`New review was added!`)
    console.log(newReview)
}


function manageYoutubePlayer(review) {
    if (review.isYoutubePlayerOpen) {
        document.getElementById(`player-${review.id}`).innerHTML = ``;
        review.isYoutubePlayerOpen = false;
    } else {
        document.getElementById(`player-${review.id}`).innerHTML = `
        <iframe width="600" height="300" src="${review.song.youtubeUrl}"></iframe>
        `;
        review.isYoutubePlayerOpen = true;
    }
}

function createReviewElement(reviewObj) {
    const {name, artist, album} = reviewObj.song;
    const {nickname, email} = reviewObj.reviewer;
    const style = `color: ${websiteSettings.reviewsColor}; font-size: ${websiteSettings.reviewsFontSize}px;`
    return `
        <section id="${reviewObj.id}" style="opacity: ${websiteSettings.reviewsOpacity}%; cursor: pointer;">
            <h3>${name}</h3>
            <p><strong style="${style}">Artist:</strong> ${artist}</p>
            <p><strong style="${style}">Album:</strong> ${album}</p>
            <div id="player-${reviewObj.id}"></div>
            <p><strong style="${style}">Review:</strong> ${reviewObj.review}</p>
            <p><strong style="${style}">Nickname:</strong> ${nickname}</p>
            <p><strong style="${style}">Reviewer email:</strong> ${email}</p>
        </section>
        `
}


