<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>
    <style>
        body {
            margin: 0%;
            background-color: yellow;
        }

        .HEAD {
            width: 100%;
            height: 150px;
            background-color: #89fc00;
        }

        .HEAD_LEFT {
            background-color: #2bc016;
            color: #e9ecef;
            height: 150px;
            width: 100%;
            margin: 0%;
            font-size: 70px;
            font-weight: bold;
            margin-right: 100px;
            font-family: 'Roboto Slab', serif;
            box-shadow: inset -5px -5px 10px black;
        }

        .HEAD_LEFT > p {
            margin: 0%;
            font-size: 30px;
        }

        .HEAD_LEFT > img {
            height: 60px;
            width: 50px;
            padding-top: 15px;
        }

        .FEEDBACK {
  height: 50px;
  width: 100%;
  background-color: lightgray;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
  margin-bottom: 20px;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
  box-shadow: 2px 2px 10px black;
}

.FEEDBACK > p {
  font-size: 20px;
  font-weight: bold;
}

.FEEDBACK > button {
  padding: 2px;
  font-size: 15px;
  font-weight: bold;
  margin-left: 10px;
  height: 25px;
  width: 100px;
}

.END {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  background-color: lightgray;
  border: 2px solid black;
  box-shadow: 2px 2px 10px black;
  margin-bottom: 20px;
}

.SOCIAL_MEDIA {
  padding: 10px;
  height: 160px;
}

.SOCIAL_MEDIA > div {
  height: 80px;
}

.S_IMG {
  height: 40px;
  margin-right: 2px;
  margin-top: 15px;
  width: 40px;
}

.CONTACT_US {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.CONTACT_US > p {
  margin: 10px;
  font-size: 30px;
  font-weight: bold;
}

.CONTACT_US > a {
  margin: 5px;
  font-size: 20px;
  font-weight: 200;
}

.LINKS {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.LINKS > p {
  margin: 10px;
  font-size: 30px;
  font-weight: bold;
}

.LINKS > a {
  color: black;
  margin: 1px;
  font-size: 20px;
  font-weight: 200;
}

.BOTTOM_TAG {
  padding-top: 20px;
  padding-bottom: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  background-color: white;
  text-align: center;
  font-size: 18px;
  font-weight: bold;
  margin-top: 20px;
  box-shadow: 2px 2px 10px black;
  border-top: 2px solid black;
}

.search-results {
            color: black;
            font-size:30px;
        }

        .search-results .result-item {
            background-color:lightgray;
            padding: 10px;
            margin-bottom: 10px;
            border:5px solid black;
            box-shadow:inset -5px -5px 10px black;

        }

        .search-results .result-item .item-name {
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div style="height: 100%; width: 100%">
    
        <div class="HEAD">
            <div class="HEAD_LEFT">
                ReThinkReFab
                <img src="MainPage_IMG/recycle.png" />
                <p>Crafting a Better Future from Your Everyday</p>
            </div>
        </div>

        <div class="search-results">
        
        <?php
        session_start();

            try {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database_name = "PROJECT";

                    $conn = mysqli_connect($servername, $username, $password, $database_name);
                    if (!$conn) {
                        throw new Exception("CONNECTION FAILED" . mysqli_connect_error());
                    }

                    $search_material = mysqli_real_escape_string($conn, $_POST['search_material']);

                    if (empty($search_material)) {
                        echo "<p>Please enter a material to search.</p>";
                    } else {
                        $sql_query = "SELECT * FROM user_product WHERE MATERIALS LIKE '%$search_material%'";
                        $result = mysqli_query($conn, $sql_query);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<h1 class='search-results' style='font-size:100px;margin:10px;text-align:center'>Results</h1>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='result-item'>";
                                echo "<br>";
                                echo "<strong>Item:</strong> <span class='item-name'>" . $row['ITEM'] . "</span><br>";
                                echo "<br>";
                                echo "<strong>Materials:</strong> " . $row['MATERIALS'] . "<br>";
                                echo "<br>";
                                echo "<strong>Steps:</strong> " . $row['STEPS'] . "<br>";
                                echo "<br>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>No results found.</p>";
                        }
                    }

                    mysqli_close($conn);
                } else {
                    throw new Exception("POST variables are not set.");
                }
            } catch (Exception $e) {
                echo '<html>
                <head>
                    <title>Error</title>
                    <style>
                        body {
                            font-size: 24px;
                            text-align: center;
                            margin-top: 100px;
                        }
                        .regular-content {
                            display: none;
                        }
                    </style>
                </head>
                <body>
                    <div style="font-size:50px";>' . $e->getMessage() . '</div>
                    <script>
                        setTimeout(function(){
                            window.location.href = "SearchIdea.html";
                        }, 3000);
                    </script>
                </body>
              </html>';
            }
            ?>

        </div>
        <div class="FEEDBACK">
          <p>Was this page useful? Let us know your feedback.</p>
          <button>FeedBack</button>
        </div>
      </div>
      <div>
        <div class="END">
          <div class="CONTACT_US">
            <p>Help and information</p>
            <a>Who We Are And What We Do?</a>
            <a>Contact RethinkRefab Now</a>
          </div>
          <div class="LINKS">
            <p>Useful Links</p>
            <a href="https://www.thekabadiwala.com/" target="_blank"
              >thekabadiwala</a
            >
            <a href="https://scrapuncle.com/" target="_blank">ScrapUncle</a>
          </div>
          <div class="SOCIAL_MEDIA">
            <p style="margin-bottom: 5px; font-size: 30px; font-weight: bold">
              Follow us
            </p>
            <p
              style="
                margin-top: 5px;
                margin-bottom: 5px;
                font-size: 18px;
                font-weight: bold;
              "
            >
              For the latest recycling news and tips
            </p>
            <img src="MainPage_IMG/instagram.png" class="S_IMG" />
            <img src="MainPage_IMG/facebook.png" class="S_IMG" />
            <img src="MainPage_IMG/twitter.png" class="S_IMG" />
            <img src="MainPage_IMG/youtube.png" class="S_IMG" />
          </div>
        </div>
        <div class="BOTTOM_TAG">
          The Waste and Resources Action Programme (which operates as WRAP) is a
          registered UK Charity No. 1159512. Registered office at Second Floor,
          Blenheim Court, 19 George Street, Banbury, Oxon, OX16 5BH.
        </div>
      </div>
    </div>
    </div>
</body>
</html>
