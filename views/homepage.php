<?php include_once('header.php') ?>
<main>
    <section id="banner" class="container-fluid text-center mt-5">
        <div class="row">
            <div class="col">
                <h1>Build whatever.<br>Eat wherever.</h1>
                <p class="lead">Build your very own food container. Unlimited combinations.</p>
                <p class="my-4">
                    <button type="button" class="mx-2 btn btn-selected">Start building</button>
                    <button type="button" class="mx-2 btn btn-normal">Learn more about DockerEats</button>
                </p>
            </div>
        </div>
        <div class="bannerContainer mt-5">
            <img src="/img/TupperContainer.png" class="undraggable"  alt="DockerEats Container">
        </div>
    </section>

    <section id="whatis" class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-8 text-center mx-auto">
                <h2>What is DockerEats?</h2>
                <h3>A completely customizable experience for every customer</h3>
                <p>DockerEats is the latest branch in the Docker family, a fun and engaging way to adapt our love for containerized applications into the second most important helper for a developer — Food!</p>
                <div class="d-flex justify-content-center mt-5 gap-3">
                    <button type="button" class="btn btn-secondary btn-selected">Containers</button>
                    <button type="button" class="btn btn-secondary btn-normal">Customize</button>
                    <button type="button" class="btn btn-secondary btn-normal">Purchase</button>
                    <button type="button" class="btn btn-secondary btn-normal">Deliver</button>
                </div>
            </div>
        </div>
        <div class="whatisBody row mt-5">
            <div class="col-lg-6">
                <h4>Containers</h4>
                <div class="textPar">
                    <h5>A container with a whole course meal inside</h5>
                    <p>A DockerEats container has all the necessary ingredients, parts and preparation for an entire meal, all in one small package. Plus, you'll be able to build your own container, customizing your culinary experience to the max.</p>
                </div>
                <div class="textPar">
                    <h5>Healthy, compact and light</h5>
                    <p>Our DockerEats brand containers are extremely light and easily transported, keep food fresh, hot (or cold!) whatever the weather may be. You can even keep them after the food has been eaten to use them as normal containers!</p>
                </div>
                <div class="textPar">
                    <h5>Freshly-made, freshly-eaten</h5>
                    <p>Our delivery is quick to make sure your food is as fresh when it gets to you as it was when it left our kitchen. Precooked is not in our dictionary — everything you eat has been freshly prepared and cooked the same day!</p>
                </div>
            </div>
            <br>
            <div class="whatisBodyImage col-lg-6">
                <img src="/img/TupperContainer.png" class="undraggable" alt="">
            </div>
        </div>
        <div class="row">
            <button type="button" class="btn btn-selected">View the menu</button>
            <button type="button" class="btn btn-normal">Our ingredients</button>
        </div>
    </section>
    <section id="whyorder">
        <div class="whyorderContainer">
            <div class="whyorderText">
                <h2>Why order DockerEats?</h2>
                <h3>Already trusted by developers.<br>Now trusted by consumers.</h3>
                <p>DockerEats allows you to eat whatever you want, whenever and wherever you want. And most importantly, eat it the way you want. Much like our containers, we completely adapt to our customer's wants and needs.</p>
                <a href="#">Read our reviews ➜</a>
            </div>
        </div>
    </section>
</main>
<?php include_once('footer.php') ?>