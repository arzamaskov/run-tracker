<script>
  import Header from "./lib/Header.svelte";
  import Hero from "./lib/Hero.svelte";
  import Features from "./lib/Features.svelte";
  import HowItWorks from "./lib/HowItWorks.svelte";
  import FAQ from "./lib/FAQ.svelte";
  import Footer from "./lib/Footer.svelte";
  import Login from "./lib/Login.svelte";
  import Register from "./lib/Register.svelte";
  import { onMount } from "svelte";

  let currentPath = window.location.hash;

  onMount(() => {
    const handleHashChange = () => {
      currentPath = window.location.hash;
      window.scrollTo(0, 0);
    };

    window.addEventListener("hashchange", handleHashChange);
    return () => {
      window.removeEventListener("hashchange", handleHashChange);
    };
  });
</script>

<Header />
<main>
  {#if currentPath === "#login"}
    <Login />
  {:else if currentPath === "#register"}
    <Register />
  {:else}
    <Hero />
    <Features />
    <HowItWorks />
    <FAQ />
  {/if}
</main>
<Footer />
