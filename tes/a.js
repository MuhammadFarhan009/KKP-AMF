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

        const labelKecamatan = [];

        for (let i = 0; i < data.turvar.length; i++){
            labelKecamatan.push(data.turvar[i].label)
        }
        
        const dataTahun = [];

        // dataTahun.push(data.datacontent[11012001971080])
        // 11012001971090
        
        // const dataLengkap = [];
        
        // vervar looping
        // console.log(data.vervar[0].val,data.var[0].val, )
        // let tumbal = String(data.vervar[0].val) + String(data.var[0].val) + String(data.turvar[0].val) + String(data.tahun[0].val) + String(data.turtahun[0].val)
        // console.log(tumbal)
        // console.log(data.turvar.length)
        // console.log(data.datacontent.keys)

        Object.entries(data.datacontent).forEach(entry => {
            // console.log("Key:", entry[0]);
            // console.log("Value:", entry[1]);

            dataTahun.push(entry[1])
          });
          

        displayJSONData(status, availability, firstVarItem, labeldata, labelKecamatan, dataTahun);
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
function displayJSONData(status, availability, firstVarItem, labeldata, labelKecamatan, dataTahun) {
    const jsonDataDiv = document.getElementById('jsonData');
    jsonDataDiv.innerHTML = `
    <p>Status: ${status}</p>
    <p>Availability: ${availability}</p>
    <p>First var item: ${firstVarItem}</p>
    <p>Label data : ${labeldata}</p>
    <p>kecamatan data : ${labelKecamatan}</p>
    <p>data untuk tahun sekian : ${dataTahun}</p>
    `;

}

// Fetch and display the JSON data when the page loads
document.addEventListener('DOMContentLoaded', fetchJSONData);
// console.log(fetchJSONData())
