window.addEventListener('load', function () {
    // Hide the loading animation when the page is fully loaded
    document.getElementById('load').style.display = 'none';
  });


  // Simulate an asynchronous action (e.g., fetching data)
  function simulateAsyncAction() {
    // Display the loading animation while the asynchronous action is in progress
    document.getElementById('load').style.display = 'flex';
      

    // Simulate an asynchronous action with setTimeout
    setTimeout(function () {
      // Hide the loading animation when the action is complete
      document.getElementById('load').style.display = 'none';
    }, 2000); // Replace 2000 with the actual time your action takes
  }

  // Example: Call the simulateAsyncAction function when a button is clicked
  document.getElementById('your-button-id').addEventListener('click', simulateAsyncAction);
