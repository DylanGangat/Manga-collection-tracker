// const mangaTitles = document.querySelectorAll("[data-manga-title]");
// const mangaImages = document.querySelectorAll("[data-manga-image]");
// // mangaTitles.forEach(item => console.log(getManga(item.textContent)));

// const getManga = async name => {
//   const URL = `https://api.jikan.moe/v4/manga?q=${name}&order_by=score`;
//   console.log(URL);
//   const response = await fetch(URL);

//   if (!response.ok) return;
//   try {
//     const result = await response.json();
//     const manga = result.data.slice(0, 1)[0];
//     const image = manga.images.webp.image_url;
//     console.log(manga, image);
//     mangaImages.forEach(item => (item.src = image));
//     // console.log(result);
//   } catch (e) {
//     console.error(e);
//   }
// };

// getManga("Monster");
