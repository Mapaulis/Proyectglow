* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
}

.top-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #111;
  color: white;
  padding: 15px 30px;
  flex-wrap: wrap;
}

.logo {
  font-size: 22px;
  font-weight: bold;
}

.logo span {
  color: orange;
  font-style: italic;
}

.menu {
  display: flex;
  gap: 20px;
}

.menu a {
  color: white;
  text-decoration: none;
  font-weight: 500;
}

.icons a {
  color: white;
  margin-left: 15px;
  font-size: 18px;
}

/* HERO SECTION */
.hero {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.hero-buttons button {
  padding: 12px 24px;
  margin: 10px;
  border: none;
  border-radius: 20px;
  background-color: #fcb900;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s;
}

.hero-buttons button:hover {
  background-color: #e0a800;
}

/* ✅ RESPONSIVE */
@media (max-width: 768px) {
  .top-header {
    flex-direction: column;
    align-items: flex-start;
  }

  .menu {
    flex-direction: column;
    width: 100%;
    gap: 10px;
    margin-top: 10px;
  }

  .icons {
    margin-top: 10px;
  }

  .hero {
    padding: 20px;
    text-align: center;
  }

  .hero-buttons {
    flex-direction: column;
  }

  .hero-buttons button {
    width: 100%;
    max-width: 250px;
  }
}
