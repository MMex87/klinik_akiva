// Diagnosa

var counts = 1;
function add_more_diagnosa(){
    counts+=1;
    if(counts == 2){
        html='<tr>\
            <th style="width: 20%;">S</th>\
            <th style="width: 20%;">O</th>\
            <th style="width: 30%;">A</th>\
            <th style="width: 30%;">P</th>\
        </tr>\
        <tr>\
            <td class="p-2"><h5></h5></td>\
            <td class="p-2"><h5></h5></td>\
            <td class="p-2">\
                <h7 name="diagnosa" id="diagnosaH7" value="<?= $_POST["diagnosa"] ?>">\
                </h7>\
            </td>\
            <td class="p-2">\
                <div class = "float-start me-3">\
                    <label for="namaObat">Nama Obat</label><br>\
                    <input type="text" name="namaObat'+counts+'" id="namaObat" style="width: 200px;" value="<?= $_POST["namaObat1"] ?>">\
                </div>\
                <div class = "float-start">\
                    <label for="jumlah">jumlah</label><br>\
                    <input type="text" name="jumlah'+counts+'" id="jumlah" style="width: 50px;">\
                </div>\
            </td>\
        </tr>'
    }else{
        html='<tr>\
            <td class="p-2"><h5></h5></td>\
            <td class="p-2"><h5></h5></td>\
            <td class="p-2">\
                <h7 name="diagnosa" id="diagnosaH7 value="<?= $_POST["diagnosa"] ?>"">\
                </h7>\
            </td>\
            <td class="p-2">\
                <div class = "float-start me-3">\
                    <label for="namaObat">Nama Obat</label><br>\
                    <input type="text" name="namaObat'+counts+'" id="namaObat" style="width: 200px;">\
                </div>\
                <div class = "float-start">\
                    <label for="jumlah">jumlah</label><br>\
                    <input type="text" name="jumlah'+counts+'" id="jumlah" style="width: 50px;">\
                </div>\
            </td>\
        </tr>'
    }
    

    var form = document.getElementById('countDiagnosaObat')
    form.innerHTML+=html
}

function remove_more_diagnosa(){
    counts=1;
    html='<div class = "float-start" id="row'+counts+'">\
        <select name="diagnosa'+counts+'" id="diagnosa">\
            <option value="ISPA">ISPA</option>\
            <option value="HT">HT</option>\
            <option value="CHF">CHF</option>\
            <option value="DM non Insulin">DM non Insulin</option>\
            <option value="DM Insulin">DM Insulin</option>\
            <option value="Febris">Febris</option>\
            <option value="LBP">LBP</option>\
            <option value="OA">OA</option>\
            <option value="KIA">KIA</option>\
            <option value="GASTRITIS">GASTRITIS</option>\
            <option value="Headache">Headache</option>\
            <option value="LVA">LVA</option>\
        </select>\
        </div>'

    var form = document.getElementById('countDiagnosa')
    form.innerHTML=html
}


//  Obat 
var count = 1;
function add_more_obat(){
    count+=1;
    html='<div class = "float-start" id="row'+count+'">\
        <label for="namaObat">Nama Obat</label><br>\
        <input type="text" name="namaObat'+count+'" id="namaObat" style="width: 150px;">\
        </div>\
        <div class = "float-start ms-3">\
        <label for="jumlah">Jumlah</label><br>\
        <input type="text" name="jumlah'+count+'" id="jumlah" style="width: 50px;" >\
        </div><br>'

    var form = document.getElementById('countDataObat')
    form.innerHTML+=html
}

function remove_more_obat(){
    count=1;
    html='<div class = "float-start" id="row'+count+'">\
            <label for="namaObat">Nama Obat</label><br>\
            <input type="text" name="namaObat'+count+'" id="namaObat" style="width: 150px;">\
            </div>\
            <div class = "float-start ms-3">\
            <label for="jumlah">Jumlah</label><br>\
            <input type="text" name="jumlah'+count+'" id="jumlah" style="width: 50px;" >\
        </div>\
        <div class = "float-start ms-5 mt-3">\
            <button type="button" style="border-radius: 180px; background-color: green; width: 30px;"  onclick="add_more_obat()">+</button>\
            <button type="button" style="border-radius: 180px; background-color: red; width: 30px;" onclick="remove_more_obat()">x</button>\
        </div>'

    var form = document.getElementById('countDataObat')
    form.innerHTML=html
}