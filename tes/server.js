// Function to fetch JSON data
async function fetchJSONData() {
    try {
        const response = await fetch('https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1100/var/200/key/e437040ac2bc6886742a0bfab5a46355/');
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();

        const status = data.status; // Dot notation
        const availability = data['data-availability']; // Bracket notation
        const firstVarItem = data.var[0].note;

        const labeldata = [];

        for (let i = 0; i < data.vervar.length; i++){
            // data.vervar[i].label.push(labeldata);
            labeldata.push(data.vervar[i].label)
        }
        
        // console.log(data.turvar.length)

        displayJSONData(status, availability, firstVarItem, labeldata);
    } catch (error) {
        console.error('Fetch error:', error);
    }
}

// // Function to display JSON data in HTML
// function displayJSONData(data) {
//     const jsonDataDiv = document.getElementById('jsonData');
//     jsonDataDiv.innerHTML = JSON.stringify(data, null, 2);
// }

// display specific value 
function displayJSONData(status, availability, firstVarItem, labeldata){
    const jsonDataDiv = document.getElementById('jsonData');
    jsonDataDiv.innerHTML = `
    <p>Status: ${status}</p>
    <p>Availability: ${availability}</p>
    <p>First var item: ${firstVarItem}</p>
    <p>Label data : ${labeldata}</p>
    `;

}

// Fetch and display the JSON data when the page loads
document.addEventListener('DOMContentLoaded', fetchJSONData);
// console.log(fetchJSONData())
