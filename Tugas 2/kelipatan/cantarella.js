
document.addEventListener('DOMContentLoaded', function() {
   
    const inputKelipatan = document.getElementById('kelipatan');
    const kirimButton = document.getElementById('kirim');
    const tableBody = document.querySelector('#kelipatan-table tbody');
    
    
    inputKelipatan.value = 1;
    generateTable(1);
    
    kirimButton.addEventListener('click', function() {
        const kelipatan = parseInt(inputKelipatan.value) || 1;
        generateTable(kelipatan);
    });
    
   
    inputKelipatan.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            const kelipatan = parseInt(inputKelipatan.value) || 1;
            generateTable(kelipatan);
        }
    });
    
  
    function generateTable(multiplier) {
    
        tableBody.innerHTML = '';
        
       
        for (let i = 1; i <= 12; i++) {
         
            const row = document.createElement('tr');
            
           
            const angkaCell = document.createElement('td');
            angkaCell.textContent = i;
            row.appendChild(angkaCell);
            
         
            const kelipatanCell = document.createElement('td');
            kelipatanCell.textContent = i * multiplier;
            row.appendChild(kelipatanCell);
            
    
            tableBody.appendChild(row);
        }
    }
});