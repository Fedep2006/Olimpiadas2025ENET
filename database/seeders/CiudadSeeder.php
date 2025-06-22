<?php

namespace Database\Seeders;

use App\Models\ubicacion\Ciudad;
use App\Models\ubicacion\Pais;
use App\Models\ubicacion\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = [
            "Argentina" => [
                "Buenos Aires" => [
                    "La Plata",
                    "Mar del Plata",
                    "Bahía Blanca",
                    "Tandil",
                    "Quilmes",
                    "Bahía Blanca",
                    "San Nicolás",
                    "Olavarría"
                ],
                "Catamarca" => [
                    "San Fernando del Valle de Catamarca",
                    "Tinogasta",
                    "Belén",
                    "Santa María",
                    "Recreo",
                    "Andalgalá"
                ],
                "Chaco" => [
                    "Resistencia",
                    "Sáenz Peña",
                    "Barranqueras",
                    "Presidencia Roque Sáenz Peña",
                    "Villa Ángela",
                    "Castelli"
                ],
                "Chubut" => [
                    "Rawson",
                    "Trelew",
                    "Puerto Madryn",
                    "Comodoro Rivadavia",
                    "Madryn",
                    "Esquel",
                    "Gaiman"
                ],
                "Córdoba" => [
                    "Córdoba",
                    "Villa Carlos Paz",
                    "Río Cuarto",
                    "San Francisco",
                    "Río Tercero",
                    "Alta Gracia",
                    "Bell Ville"
                ],
                "Corrientes" => [
                    "Corrientes",
                    "Goya",
                    "Paso de los Libres",
                    "Mercedes",
                    "Ituzaingó",
                    "Curuzú Cuatiá",
                    "Esquina"
                ],
                "Entre Ríos" => [
                    "Paraná",
                    "Concordia",
                    "Gualeguaychú",
                    "Gualeguay",
                    "Victoria",
                    "Concepción del Uruguay",
                    "La Paz"
                ],
                "Formosa" => [
                    "Formosa",
                    "Clorinda",
                    "El Colorado",
                    "Pirané",
                    "Herradura",
                    "Ibarreta",
                    "Laguna Blanca"
                ],
                "Jujuy" => [
                    "San Salvador de Jujuy",
                    "Palpalá",
                    "Perico",
                    "Libertador General San Martín",
                    "Tilcara",
                    "Humahuaca"
                ],
                "La Pampa" => [
                    "Santa Rosa",
                    "General Pico",
                    "Eduardo Castex",
                    "General Acha",
                    "Realicó",
                    "Huinca Renancó",
                    "Macachín"
                ],
                "La Rioja" => [
                    "La Rioja",
                    "Chilecito",
                    "Aimogasta",
                    "Chepes",
                    "Villa Unión",
                    "Anillaco"
                ],
                "Mendoza" => [
                    "Mendoza",
                    "San Rafael",
                    "Godoy Cruz",
                    "San Martín",
                    "Luján de Cuyo",
                    "Tunuyán",
                    "Las Heras"
                ],
                "Misiones" => [
                    "Posadas",
                    "Oberá",
                    "Eldorado",
                    "Apóstoles",
                    "Puerto Iguazú",
                    "Montecarlo",
                    "San Vicente"
                ],
                "Neuquén" => [
                    "Neuquén",
                    "Plottier",
                    "Zapala",
                    "Centenario",
                    "San Martín de los Andes",
                    "Villa La Angostura",
                    "Cutral Có"
                ],
                "Río Negro" => [
                    "Viedma",
                    "Bariloche",
                    "General Roca",
                    "San Carlos de Bariloche",
                    "Cipolletti",
                    "Allen",
                    "Tierra del Fuego"
                ],
                "Salta" => [
                    "Salta",
                    "San Ramón de la Nueva Orán",
                    "Cafayate",
                    "General Güemes",
                    "Metán",
                    "Rosario de la Frontera"
                ],
                "San Juan" => [
                    "San Juan",
                    "Rivadavia",
                    "Chimbas",
                    "Rawson",
                    "9 de Julio",
                    "Santa Lucía",
                    "Pocito"
                ],
                "San Luis" => [
                    "San Luis",
                    "Villa Mercedes",
                    "Merlo",
                    "Justo Daract",
                    "La Punta",
                    "Buena Esperanza"
                ],
                "Santa Cruz" => [
                    "Río Gallegos",
                    "Caleta Olivia",
                    "El Calafate",
                    "Ushuaia",
                    "Puerto Deseado",
                    "Comandante Luis Piedrabuena"
                ],
                "Santa Fe" => [
                    "Santa Fe",
                    "Rosario",
                    "Rafaela",
                    "Venado Tuerto",
                    "Reconquista",
                    "Sunchales",
                    "San Lorenzo"
                ],
                "Santiago del Estero" => [
                    "Santiago del Estero",
                    "La Banda",
                    "Termas de Río Hondo",
                    "Las Termas",
                    "Frías",
                    "Añatuya"
                ],
                "Tierra del Fuego" => [
                    "Ushuaia",
                    "Río Grande",
                    "Tolhuin"
                ],
                "Tucumán" => [
                    "San Miguel de Tucumán",
                    "Concepción",
                    "Tafí Viejo",
                    "Yerba Buena",
                    "Lules",
                    "Bella Vista"
                ],
                "Ciudad Autónoma de Buenos Aires" => [
                    "Palermo",
                    "Recoleta",
                    "Belgrano",
                    "Caballito",
                    "Flores",
                    "San Telmo",
                    "Puerto Madero"
                ]
            ],
            "Brasil" => [
                "Acre" => [
                    "Rio Branco",
                    "Cruzeiro do Sul",
                    "Sena Madureira",
                    "Tarauacá",
                    "Feijó",
                    "Brasileia",
                    "Xapuri"
                ],
                "Alagoas" => [
                    "Maceió",
                    "Arapiraca",
                    "Palmeira dos Índios",
                    "Rio Largo",
                    "Penedo",
                    "União dos Palmares",
                    "São Miguel dos Campos"
                ],
                "Amapá" => [
                    "Macapá",
                    "Santana",
                    "Laranjal do Jari",
                    "Oiapoque",
                    "Mazagão",
                    "Porto Grande",
                    "Pedra Branca do Amapari"
                ],
                "Amazonas" => [
                    "Manaus",
                    "Parintins",
                    "Itacoatiara",
                    "Maués",
                    "Coari",
                    "Tefé",
                    "Tabatinga"
                ],
                "Bahia" => [
                    "Salvador",
                    "Feira de Santana",
                    "Vitória da Conquista",
                    "Camaçari",
                    "Juazeiro",
                    "Ilhéus",
                    "Itabuna"
                ],
                "Ceará" => [
                    "Fortaleza",
                    "Caucaia",
                    "Juazeiro do Norte",
                    "Maracanaú",
                    "Sobral",
                    "Crato",
                    "Itapipoca"
                ],
                "Distrito Federal" => [
                    "Brasília",
                    "Taguatinga",
                    "Ceilândia",
                    "Gama",
                    "Planaltina",
                    "Sobradinho",
                    "Águas Claras"
                ],
                "Espírito Santo" => [
                    "Vitória",
                    "Vila Velha",
                    "Serra",
                    "Cariacica",
                    "Cachoeiro de Itapemirim",
                    "Linhares",
                    "Colatina"
                ],
                "Goiás" => [
                    "Goiânia",
                    "Aparecida de Goiânia",
                    "Anápolis",
                    "Rio Verde",
                    "Luziânia",
                    "Águas Lindas de Goiás",
                    "Valparaíso de Goiás"
                ],
                "Maranhão" => [
                    "São Luís",
                    "Imperatriz",
                    "Caxias",
                    "Timon",
                    "Codó",
                    "Paço do Lumiar",
                    "Açailândia"
                ],
                "Mato Grosso" => [
                    "Cuiabá",
                    "Várzea Grande",
                    "Rondonópolis",
                    "Sinop",
                    "Tangará da Serra",
                    "Cáceres",
                    "Barra do Garças"
                ],
                "Mato Grosso do Sul" => [
                    "Campo Grande",
                    "Dourados",
                    "Três Lagoas",
                    "Corumbá",
                    "Ponta Porã",
                    "Naviraí",
                    "Nova Andradina"
                ],
                "Minas Gerais" => [
                    "Belo Horizonte",
                    "Uberlândia",
                    "Contagem",
                    "Juiz de Fora",
                    "Betim",
                    "Montes Claros",
                    "Ribeirão das Neves"
                ],
                "Pará" => [
                    "Belém",
                    "Ananindeua",
                    "Santarém",
                    "Marabá",
                    "Parauapebas",
                    "Castanhal",
                    "Abaetetuba"
                ],
                "Paraíba" => [
                    "João Pessoa",
                    "Campina Grande",
                    "Santa Rita",
                    "Patos",
                    "Bayeux",
                    "Sousa",
                    "Cajazeiras"
                ],
                "Paraná" => [
                    "Curitiba",
                    "Londrina",
                    "Maringá",
                    "Ponta Grossa",
                    "Cascavel",
                    "São José dos Pinhais",
                    "Foz do Iguaçu"
                ],
                "Pernambuco" => [
                    "Recife",
                    "Jaboatão dos Guararapes",
                    "Olinda",
                    "Caruaru",
                    "Petrolina",
                    "Paulista",
                    "Cabo de Santo Agostinho"
                ],
                "Piauí" => [
                    "Teresina",
                    "Parnaíba",
                    "Picos",
                    "Piripiri",
                    "Floriano",
                    "Campo Maior",
                    "Barras"
                ],
                "Rio de Janeiro" => [
                    "Rio de Janeiro",
                    "São Gonçalo",
                    "Duque de Caxias",
                    "Nova Iguaçu",
                    "Niterói",
                    "Belford Roxo",
                    "Campos dos Goytacazes"
                ],
                "Rio Grande do Norte" => [
                    "Natal",
                    "Mossoró",
                    "Parnamirim",
                    "São Gonçalo do Amarante",
                    "Macaíba",
                    "Ceará-Mirim",
                    "Caicó"
                ],
                "Rio Grande do Sul" => [
                    "Porto Alegre",
                    "Caxias do Sul",
                    "Pelotas",
                    "Canoas",
                    "Santa Maria",
                    "Gravataí",
                    "Viamão"
                ],
                "Rondônia" => [
                    "Porto Velho",
                    "Ji-Paraná",
                    "Ariquemes",
                    "Vilhena",
                    "Cacoal",
                    "Rolim de Moura",
                    "Guajará-Mirim"
                ],
                "Roraima" => [
                    "Boa Vista",
                    "Caracaraí",
                    "Rorainópolis",
                    "São João da Baliza",
                    "São Luiz",
                    "Mucajaí",
                    "Alto Alegre"
                ],
                "Santa Catarina" => [
                    "Florianópolis",
                    "Joinville",
                    "Blumenau",
                    "São José",
                    "Criciúma",
                    "Chapecó",
                    "Itajaí"
                ],
                "São Paulo" => [
                    "São Paulo",
                    "Guarulhos",
                    "Campinas",
                    "São Bernardo do Campo",
                    "Santo André",
                    "Osasco",
                    "Ribeirão Preto"
                ],
                "Sergipe" => [
                    "Aracaju",
                    "Nossa Senhora do Socorro",
                    "Lagarto",
                    "Itabaiana",
                    "São Cristóvão",
                    "Estância",
                    "Tobias Barreto"
                ],
                "Tocantins" => [
                    "Palmas",
                    "Araguaína",
                    "Gurupi",
                    "Porto Nacional",
                    "Paraíso do Tocantins",
                    "Colinas do Tocantins",
                    "Guaraí"
                ]
            ],
            "Chile" => [
                "Arica y Parinacota" => [
                    "Arica",
                    "Putre",
                    "General Lagos",
                    "Camarones",
                    "Codpa",
                    "Socoroma",
                    "Belén"
                ],
                "Tarapacá" => [
                    "Iquique",
                    "Alto Hospicio",
                    "Pozo Almonte",
                    "Camiña",
                    "Colchane",
                    "Huara",
                    "Pica"
                ],
                "Antofagasta" => [
                    "Antofagasta",
                    "Calama",
                    "Tocopilla",
                    "Mejillones",
                    "Taltal",
                    "San Pedro de Atacama",
                    "María Elena"
                ],
                "Atacama" => [
                    "Copiapó",
                    "Vallenar",
                    "Chañaral",
                    "Caldera",
                    "Diego de Almagro",
                    "Huasco",
                    "Freirina"
                ],
                "Coquimbo" => [
                    "La Serena",
                    "Coquimbo",
                    "Ovalle",
                    "Illapel",
                    "Vicuña",
                    "Andacollo",
                    "Los Vilos"
                ],
                "Valparaíso" => [
                    "Valparaíso",
                    "Viña del Mar",
                    "Quilpué",
                    "Villa Alemana",
                    "San Antonio",
                    "Quillota",
                    "San Felipe"
                ],
                "Metropolitana de Santiago" => [
                    "Santiago",
                    "Puente Alto",
                    "Maipú",
                    "Las Condes",
                    "La Florida",
                    "Providencia",
                    "Ñuñoa"
                ],
                "Libertador General Bernardo O'Higgins" => [
                    "Rancagua",
                    "San Fernando",
                    "Rengo",
                    "Pichilemu",
                    "Santa Cruz",
                    "Graneros",
                    "Machalí"
                ],
                "Maule" => [
                    "Talca",
                    "Curicó",
                    "Linares",
                    "Cauquenes",
                    "Constitución",
                    "Molina",
                    "Parral"
                ],
                "Ñuble" => [
                    "Chillán",
                    "San Carlos",
                    "Bulnes",
                    "Quirihue",
                    "Yungay",
                    "Pemuco",
                    "Coihueco"
                ],
                "Biobío" => [
                    "Concepción",
                    "Talcahuano",
                    "Los Ángeles",
                    "Chiguayante",
                    "San Pedro de la Paz",
                    "Coronel",
                    "Tomé"
                ],
                "La Araucanía" => [
                    "Temuco",
                    "Villarrica",
                    "Pucón",
                    "Angol",
                    "Victoria",
                    "Lautaro",
                    "Nueva Imperial"
                ],
                "Los Ríos" => [
                    "Valdivia",
                    "La Unión",
                    "Río Bueno",
                    "Panguipulli",
                    "Futrono",
                    "Mariquina",
                    "Lanco"
                ],
                "Los Lagos" => [
                    "Puerto Montt",
                    "Osorno",
                    "Castro",
                    "Ancud",
                    "Puerto Varas",
                    "Calbuco",
                    "Frutillar"
                ],
                "Aysén del General Carlos Ibáñez del Campo" => [
                    "Coyhaique",
                    "Puerto Aysén",
                    "Chile Chico",
                    "Cochrane",
                    "Puerto Cisnes",
                    "Villa O'Higgins",
                    "Río Ibáñez"
                ],
                "Magallanes y de la Antártica Chilena" => [
                    "Punta Arenas",
                    "Puerto Natales",
                    "Porvenir",
                    "Puerto Williams",
                    "Cerro Sombrero",
                    "Primavera",
                    "San Gregorio"
                ]
            ],

            "Colombia" => [
                "Amazonas" => [
                    "Leticia",
                    "Puerto Nariño",
                    "La Chorrera",
                    "Tarapacá",
                    "La Pedrera",
                    "Miriti-Paraná",
                    "La Victoria"
                ],
                "Antioquia" => [
                    "Medellín",
                    "Bello",
                    "Itagüí",
                    "Envigado",
                    "Turbo",
                    "Apartadó",
                    "Rionegro"
                ],
                "Arauca" => [
                    "Arauca",
                    "Saravena",
                    "Tame",
                    "Fortul",
                    "Arauquita",
                    "Puerto Rondón",
                    "Cravo Norte"
                ],
                "Atlántico" => [
                    "Barranquilla",
                    "Soledad",
                    "Malambo",
                    "Sabanagrande",
                    "Puerto Colombia",
                    "Galapa",
                    "Baranoa"
                ],
                "Bolívar" => [
                    "Cartagena",
                    "Magangué",
                    "Turbaco",
                    "El Carmen de Bolívar",
                    "Arjona",
                    "San Pablo",
                    "Mompós"
                ],
                "Boyacá" => [
                    "Tunja",
                    "Duitama",
                    "Sogamoso",
                    "Chiquinquirá",
                    "Puerto Boyacá",
                    "Villa de Leyva",
                    "Paipa"
                ],
                "Caldas" => [
                    "Manizales",
                    "Chinchiná",
                    "Villamaría",
                    "La Dorada",
                    "Riosucio",
                    "Anserma",
                    "Salamina"
                ],
                "Caquetá" => [
                    "Florencia",
                    "San Vicente del Caguán",
                    "Puerto Rico",
                    "La Montañita",
                    "Belén de los Andaquíes",
                    "Albania",
                    "Curillo"
                ],
                "Casanare" => [
                    "Yopal",
                    "Aguazul",
                    "Villanueva",
                    "Tauramena",
                    "Paz de Ariporo",
                    "Monterrey",
                    "Trinidad"
                ],
                "Cauca" => [
                    "Popayán",
                    "Santander de Quilichao",
                    "Puerto Tejada",
                    "Corinto",
                    "Guapi",
                    "Patía",
                    "Silvia"
                ],
                "Cesar" => [
                    "Valledupar",
                    "Aguachica",
                    "Codazzi",
                    "Bosconia",
                    "El Copey",
                    "Curumaní",
                    "La Jagua de Ibirico"
                ],
                "Chocó" => [
                    "Quibdó",
                    "Istmina",
                    "Condoto",
                    "Riosucio",
                    "Acandí",
                    "Turbo",
                    "Bagadó"
                ],
                "Córdoba" => [
                    "Montería",
                    "Lorica",
                    "Sahagún",
                    "Cereté",
                    "Planeta Rica",
                    "Montelíbano",
                    "Ciénaga de Oro"
                ],
                "Cundinamarca" => [
                    "Bogotá",
                    "Soacha",
                    "Girardot",
                    "Zipaquirá",
                    "Facatativá",
                    "Chía",
                    "Fusagasugá"
                ],
                "Guainía" => [
                    "Inírida",
                    "Barranco Minas",
                    "Mapiripana",
                    "San Felipe",
                    "Puerto Colombia",
                    "La Guadalupe",
                    "Cacahual"
                ],
                "Guaviare" => [
                    "San José del Guaviare",
                    "Calamar",
                    "El Retorno",
                    "Miraflores",
                    "Tomachipán",
                    "Barranquillita",
                    "Capricho"
                ],
                "Huila" => [
                    "Neiva",
                    "Pitalito",
                    "Garzón",
                    "La Plata",
                    "Campoalegre",
                    "San Agustín",
                    "Isnos"
                ],
                "La Guajira" => [
                    "Riohacha",
                    "Maicao",
                    "Uribia",
                    "Manaure",
                    "San Juan del Cesar",
                    "Villanueva",
                    "El Molino"
                ],
                "Magdalena" => [
                    "Santa Marta",
                    "Ciénaga",
                    "Fundación",
                    "Plato",
                    "El Banco",
                    "Aracataca",
                    "Zona Bananera"
                ],
                "Meta" => [
                    "Villavicencio",
                    "Acacías",
                    "Granada",
                    "Puerto López",
                    "Cumaral",
                    "San Martín",
                    "Restrepo"
                ],
                "Nariño" => [
                    "Pasto",
                    "Tumaco",
                    "Ipiales",
                    "Tuquerres",
                    "Samaniego",
                    "La Unión",
                    "Sandona"
                ],
                "Norte de Santander" => [
                    "Cúcuta",
                    "Ocaña",
                    "Villa del Rosario",
                    "Los Patios",
                    "Pamplona",
                    "Tibú",
                    "El Zulia"
                ],
                "Putumayo" => [
                    "Mocoa",
                    "Puerto Asís",
                    "Orito",
                    "Valle del Guamuez",
                    "Puerto Caicedo",
                    "Villagarzón",
                    "Sibundoy"
                ],
                "Quindío" => [
                    "Armenia",
                    "Calarcá",
                    "La Tebaida",
                    "Montenegro",
                    "Quimbaya",
                    "Circasia",
                    "Filandia"
                ],
                "Risaralda" => [
                    "Pereira",
                    "Dosquebradas",
                    "Santa Rosa de Cabal",
                    "La Virginia",
                    "Marsella",
                    "Belén de Umbría",
                    "Mistrató"
                ],
                "San Andrés y Providencia" => [
                    "San Andrés",
                    "Providencia",
                    "Santa Catalina",
                    "Johnny Cay",
                    "Rose Cay",
                    "Haynes Cay",
                    "Rocky Cay"
                ],
                "Santander" => [
                    "Bucaramanga",
                    "Floridablanca",
                    "Girón",
                    "Piedecuesta",
                    "Barrancabermeja",
                    "San Gil",
                    "Málaga"
                ],
                "Sucre" => [
                    "Sincelejo",
                    "Corozal",
                    "Sampués",
                    "San Marcos",
                    "Tolú",
                    "Morroa",
                    "Ovejas"
                ],
                "Tolima" => [
                    "Ibagué",
                    "Espinal",
                    "Melgar",
                    "Honda",
                    "Líbano",
                    "Chaparral",
                    "Purificación"
                ],
                "Valle del Cauca" => [
                    "Cali",
                    "Palmira",
                    "Buenaventura",
                    "Tuluá",
                    "Cartago",
                    "Buga",
                    "Jamundí"
                ],
                "Vaupés" => [
                    "Mitú",
                    "Carurú",
                    "Taraira",
                    "Pacoa",
                    "Yavaraté",
                    "Monfort",
                    "Villa Fátima"
                ],
                "Vichada" => [
                    "Puerto Carreño",
                    "La Primavera",
                    "Santa Rosalía",
                    "Cumaribo",
                    "Puerto Nariño",
                    "San José de Ocune",
                    "Cravo Norte"
                ],
                "Bogotá D.C." => [
                    "Bogotá",
                    "Suba",
                    "Kennedy",
                    "Engativá",
                    "Ciudad Bolívar",
                    "Bosa",
                    "San Cristóbal"
                ]
            ],

            "Ecuador" => [
                "Azuay" => [
                    "Cuenca",
                    "Gualaceo",
                    "Paute",
                    "Santa Isabel",
                    "Sígsig",
                    "Girón",
                    "San Fernando"
                ],
                "Bolívar" => [
                    "Guaranda",
                    "San Miguel",
                    "Chillanes",
                    "Chimbo",
                    "Echeandía",
                    "Las Naves",
                    "Caluma"
                ],
                "Cañar" => [
                    "Azogues",
                    "Cañar",
                    "La Troncal",
                    "Biblián",
                    "El Tambo",
                    "Déleg",
                    "Suscal"
                ],
                "Carchi" => [
                    "Tulcán",
                    "San Gabriel",
                    "Bolívar",
                    "Espejo",
                    "Mira",
                    "Montúfar",
                    "Huaca"
                ],
                "Chimborazo" => [
                    "Riobamba",
                    "Alausí",
                    "Colta",
                    "Chambo",
                    "Chunchi",
                    "Guamote",
                    "Guano"
                ],
                "Cotopaxi" => [
                    "Latacunga",
                    "La Maná",
                    "Pujilí",
                    "Salcedo",
                    "Saquisilí",
                    "Sigchos",
                    "Pangua"
                ],
                "El Oro" => [
                    "Machala",
                    "Pasaje",
                    "Santa Rosa",
                    "El Guabo",
                    "Huaquillas",
                    "Arenillas",
                    "Balsas"
                ],
                "Esmeraldas" => [
                    "Esmeraldas",
                    "Atacames",
                    "Quinindé",
                    "San Lorenzo",
                    "Eloy Alfaro",
                    "Muisne",
                    "Rioverde"
                ],
                "Galápagos" => [
                    "Puerto Ayora",
                    "Puerto Baquerizo Moreno",
                    "Puerto Villamil",
                    "Bellavista",
                    "Santa Rosa",
                    "El Progreso",
                    "Tomás de Berlanga"
                ],
                "Guayas" => [
                    "Guayaquil",
                    "Durán",
                    "Milagro",
                    "Daule",
                    "Samborondón",
                    "Playas",
                    "Yaguachi"
                ],
                "Imbabura" => [
                    "Ibarra",
                    "Otavalo",
                    "Cotacachi",
                    "Atuntaqui",
                    "Pimampiro",
                    "Urcuquí",
                    "San Miguel de Urcuquí"
                ],
                "Loja" => [
                    "Loja",
                    "Catamayo",
                    "Cariamanga",
                    "Macará",
                    "Catacocha",
                    "Alamor",
                    "Celica"
                ],
                "Los Ríos" => [
                    "Babahoyo",
                    "Quevedo",
                    "Ventanas",
                    "Vinces",
                    "Baba",
                    "Montalvo",
                    "Puebloviejo"
                ],
                "Manabí" => [
                    "Portoviejo",
                    "Manta",
                    "Chone",
                    "Bahía de Caráquez",
                    "Jipijapa",
                    "Montecristi",
                    "El Carmen"
                ],
                "Morona Santiago" => [
                    "Macas",
                    "Gualaquiza",
                    "Limón Indanza",
                    "Méndez",
                    "Santiago",
                    "Sucúa",
                    "Huamboya"
                ],
                "Napo" => [
                    "Tena",
                    "Archidona",
                    "El Chaco",
                    "Quijos",
                    "Carlos Julio Arosemena Tola",
                    "Baeza",
                    "Papallacta"
                ],
                "Orellana" => [
                    "Francisco de Orellana (El Coca)",
                    "La Joya de los Sachas",
                    "Loreto",
                    "Aguarico",
                    "Tiputini",
                    "Nuevo Rocafuerte",
                    "Dayuma"
                ],
                "Pastaza" => [
                    "Puyo",
                    "Mera",
                    "Santa Clara",
                    "Arajuno",
                    "Shell",
                    "Canelos",
                    "Montalvo"
                ],
                "Pichincha" => [
                    "Quito",
                    "Cayambe",
                    "Mejía",
                    "Rumiñahui",
                    "Santo Domingo",
                    "San Miguel de Los Bancos",
                    "Pedro Moncayo"
                ],
                "Santa Elena" => [
                    "Santa Elena",
                    "La Libertad",
                    "Salinas",
                    "Anconcito",
                    "Atahualpa",
                    "Colonche",
                    "Chanduy"
                ],
                "Santo Domingo de los Tsáchilas" => [
                    "Santo Domingo",
                    "La Concordia",
                    "Valle Hermoso",
                    "Plan Piloto",
                    "Bombolí",
                    "Zaracay",
                    "Abraham Calazacón"
                ],
                "Sucumbíos" => [
                    "Nueva Loja (Lago Agrio)",
                    "Shushufindi",
                    "Cascales",
                    "Gonzalo Pizarro",
                    "Putumayo",
                    "Sucumbíos",
                    "Cuyabeno"
                ],
                "Tungurahua" => [
                    "Ambato",
                    "Baños de Agua Santa",
                    "Pelileo",
                    "Píllaro",
                    "Quero",
                    "Cevallos",
                    "Mocha"
                ],
                "Zamora-Chinchipe" => [
                    "Zamora",
                    "Yantzaza",
                    "Gualaquiza",
                    "El Pangui",
                    "Centinela del Cóndor",
                    "Palanda",
                    "Chinchipe"
                ]
            ],

            "Paraguay" => [
                "Alto Paraguay" => [
                    "Fuerte Olimpo",
                    "Bahía Negra",
                    "Carmelo Peralta",
                    "Puerto Casado",
                    "La Victoria",
                    "Capitán Pablo Lagerenza",
                    "Nueva Asunción"
                ],
                "Alto Paraná" => [
                    "Ciudad del Este",
                    "Hernandarias",
                    "Presidente Franco",
                    "Minga Guazú",
                    "Santa Rita",
                    "Juan León Mallorquín",
                    "Itakyry"
                ],
                "Amambay" => [
                    "Pedro Juan Caballero",
                    "Bella Vista",
                    "Capitán Bado",
                    "Zanja Pytã",
                    "Karapai",
                    "Cerro Corá",
                    "Nueva Esperanza"
                ],
                "Boquerón" => [
                    "Filadelfia",
                    "Loma Plata",
                    "Mariscal Estigarribia",
                    "Neuland",
                    "Mcal. José Félix Estigarribia",
                    "Fortín Infante Rivarola",
                    "Teniente Irala Fernández"
                ],
                "Caaguazú" => [
                    "Coronel Oviedo",
                    "Caaguazú",
                    "J. Eulogio Estigarribia",
                    "Nueva Londres",
                    "Yhú",
                    "San Joaquín",
                    "La Pastora"
                ],
                "Caazapá" => [
                    "Caazapá",
                    "San Juan Nepomuceno",
                    "Yuty",
                    "Abaí",
                    "Buena Vista",
                    "General Higinio Morínigo",
                    "Maciel"
                ],
                "Canindeyú" => [
                    "Salto del Guairá",
                    "Curuguaty",
                    "La Paloma",
                    "Nueva Esperanza",
                    "Ygatimí",
                    "Corpus Christi",
                    "Francisco Caballero Álvarez"
                ],
                "Central" => [
                    "Fernando de la Mora",
                    "San Lorenzo",
                    "Lambaré",
                    "Luque",
                    "Capiatá",
                    "Ñemby",
                    "Villa Elisa"
                ],
                "Concepción" => [
                    "Concepción",
                    "Horqueta",
                    "Loreto",
                    "Belén",
                    "Yby Yaú",
                    "San Carlos",
                    "San Lázaro"
                ],
                "Cordillera" => [
                    "Caacupé",
                    "Tobatí",
                    "Atyrá",
                    "Caraguatay",
                    "Emboscada",
                    "Eusebio Ayala",
                    "Isla Pucú"
                ],
                "Guairá" => [
                    "Villarrica",
                    "Coronel Martínez",
                    "Borja",
                    "Félix Pérez Cardozo",
                    "General Eugenio A. Garay",
                    "Independencia",
                    "Itape"
                ],
                "Itapúa" => [
                    "Encarnación",
                    "Hohenau",
                    "Obligado",
                    "Bella Vista",
                    "Jesús",
                    "Carmen del Paraná",
                    "Coronel Bogado"
                ],
                "Misiones" => [
                    "San Juan Bautista",
                    "Ayolas",
                    "San Ignacio",
                    "Santa María",
                    "Santa Rosa",
                    "Santiago",
                    "Villa Florida"
                ],
                "Ñeembucú" => [
                    "Pilar",
                    "Humaitá",
                    "Laureles",
                    "Desmochados",
                    "General José Eduvigis Díaz",
                    "Guazú Cuá",
                    "Mayor José J. Martínez"
                ],
                "Paraguarí" => [
                    "Paraguarí",
                    "Pirayú",
                    "Carapeguá",
                    "Yaguarón",
                    "Ybycuí",
                    "Acahay",
                    "Escobar"
                ],
                "Presidente Hayes" => [
                    "Villa Hayes",
                    "Benjamín Aceval",
                    "Puerto Pinasco",
                    "Nanawa",
                    "José Falcón",
                    "Teniente Esteban Martínez",
                    "General José María Bruguez"
                ],
                "San Pedro" => [
                    "San Pedro de Ycuamandiyú",
                    "San Estanislao",
                    "Lima",
                    "Choré",
                    "General Elizardo Aquino",
                    "Guayaibí",
                    "Itacurubí del Rosario"
                ],
                "Asunción" => [
                    "Asunción",
                    "Trinidad",
                    "Zeballos Cué",
                    "Villa Morra",
                    "Carmelitas",
                    "Las Mercedes",
                    "San Vicente"
                ]
            ],
            "Perú" => [
                "Amazonas" => [
                    "Chachapoyas",
                    "Bagua",
                    "Bongará",
                    "Condorcanqui",
                    "Luya",
                    "Rodríguez de Mendoza",
                    "Utcubamba"
                ],
                "Áncash" => [
                    "Huaraz",
                    "Chimbote",
                    "Casma",
                    "Huari",
                    "Caraz",
                    "Yungay",
                    "Recuay"
                ],
                "Apurímac" => [
                    "Abancay",
                    "Andahuaylas",
                    "Antabamba",
                    "Aymaraes",
                    "Cotabambas",
                    "Chincheros",
                    "Grau"
                ],
                "Arequipa" => [
                    "Arequipa",
                    "Camaná",
                    "Caravelí",
                    "Castilla",
                    "Caylloma",
                    "Condesuyos",
                    "Islay"
                ],
                "Ayacucho" => [
                    "Ayacucho",
                    "Huamanga",
                    "Cangallo",
                    "Huanca Sancos",
                    "Huanta",
                    "La Mar",
                    "Lucanas"
                ],
                "Cajamarca" => [
                    "Cajamarca",
                    "Cajabamba",
                    "Celendín",
                    "Chota",
                    "Contumazá",
                    "Cutervo",
                    "Hualgayoc"
                ],
                "Callao" => [
                    "Callao",
                    "Bellavista",
                    "Carmen de la Legua",
                    "La Perla",
                    "La Punta",
                    "Ventanilla",
                    "Mi Perú"
                ],
                "Cusco" => [
                    "Cusco",
                    "Acomayo",
                    "Anta",
                    "Calca",
                    "Canas",
                    "Canchis",
                    "Chumbivilcas"
                ],
                "Huancavelica" => [
                    "Huancavelica",
                    "Acobamba",
                    "Angaraes",
                    "Castrovirreyna",
                    "Churcampa",
                    "Colcabamba",
                    "Huaytará"
                ],
                "Huánuco" => [
                    "Huánuco",
                    "Ambo",
                    "Dos de Mayo",
                    "Huacaybamba",
                    "Huamalíes",
                    "Leoncio Prado",
                    "Marañón"
                ],
                "Ica" => [
                    "Ica",
                    "Chincha",
                    "Nazca",
                    "Palpa",
                    "Pisco",
                    "Chincha Alta",
                    "Nazca"
                ],
                "Junín" => [
                    "Huancayo",
                    "Chanchamayo",
                    "Chupaca",
                    "Concepción",
                    "Jauja",
                    "Junín",
                    "Satipo"
                ],
                "La Libertad" => [
                    "Trujillo",
                    "Ascope",
                    "Bolívar",
                    "Chepén",
                    "Julcán",
                    "Otuzco",
                    "Pacasmayo"
                ],
                "Lambayeque" => [
                    "Chiclayo",
                    "Ferreñafe",
                    "Lambayeque",
                    "Monsefú",
                    "Olmos",
                    "Pimentel",
                    "Túcume"
                ],
                "Lima" => [
                    "Lima",
                    "Barranca",
                    "Cajatambo",
                    "Canta",
                    "Cañete",
                    "Huaral",
                    "Huarochirí"
                ],
                "Loreto" => [
                    "Iquitos",
                    "Alto Amazonas",
                    "Datem del Marañón",
                    "Loreto",
                    "Maynas",
                    "Requena",
                    "Ucayali"
                ],
                "Madre de Dios" => [
                    "Puerto Maldonado",
                    "Manu",
                    "Tahuamanu",
                    "Tambopata",
                    "Iñapari",
                    "Iberia",
                    "Las Piedras"
                ],
                "Moquegua" => [
                    "Moquegua",
                    "General Sánchez Cerro",
                    "Ilo",
                    "Mariscal Nieto",
                    "Omate",
                    "Quinistaquillas",
                    "Ubinas"
                ],
                "Pasco" => [
                    "Cerro de Pasco",
                    "Daniel Alcides Carrión",
                    "Oxapampa",
                    "Pasco",
                    "Villa Rica",
                    "Pozuzo",
                    "Huancabamba"
                ],
                "Piura" => [
                    "Piura",
                    "Ayabaca",
                    "Huancabamba",
                    "Morropón",
                    "Paita",
                    "Sullana",
                    "Talara"
                ],
                "Puno" => [
                    "Puno",
                    "Azángaro",
                    "Carabaya",
                    "Chucuito",
                    "El Collao",
                    "Huancané",
                    "Lampa"
                ],
                "San Martín" => [
                    "Moyobamba",
                    "Bellavista",
                    "El Dorado",
                    "Huallaga",
                    "Lamas",
                    "Mariscal Cáceres",
                    "Picota"
                ],
                "Tacna" => [
                    "Tacna",
                    "Candarave",
                    "Jorge Basadre",
                    "Tarata",
                    "Locumba",
                    "Ilabaya",
                    "Ite"
                ],
                "Tumbes" => [
                    "Tumbes",
                    "Contralmirante Villar",
                    "Zarumilla",
                    "Aguas Verdes",
                    "La Cruz",
                    "Pampas de Hospital",
                    "Casitas"
                ],
                "Ucayali" => [
                    "Pucallpa",
                    "Atalaya",
                    "Coronel Portillo",
                    "Padre Abad",
                    "Purús",
                    "Contamana",
                    "Requena"
                ]
            ],

            "Uruguay" => [
                "Artigas" => [
                    "Artigas",
                    "Bella Unión",
                    "Tomás Gomensoro",
                    "Las Piedras",
                    "Baltasar Brum",
                    "Coronado",
                    "Pintadito"
                ],
                "Canelones" => [
                    "Canelones",
                    "Las Piedras",
                    "Pando",
                    "Santa Lucía",
                    "Atlántida",
                    "La Paz",
                    "Progreso"
                ],
                "Cerro Largo" => [
                    "Melo",
                    "Río Branco",
                    "Fraile Muerto",
                    "Isidoro Noblía",
                    "Tupambaé",
                    "Aceguá",
                    "Placido Rosas"
                ],
                "Colonia" => [
                    "Colonia del Sacramento",
                    "Nueva Helvecia",
                    "Rosario",
                    "Juan Lacaze",
                    "Tarariras",
                    "Carmelo",
                    "Nueva Palmira"
                ],
                "Durazno" => [
                    "Durazno",
                    "Sarandí del Yí",
                    "Villa del Carmen",
                    "Centenario",
                    "Carlos Reyles",
                    "Blanquillo",
                    "La Paloma"
                ],
                "Flores" => [
                    "Trinidad",
                    "Ismael Cortinas",
                    "Andresito",
                    "Cerro Colorado",
                    "25 de Agosto",
                    "25 de Mayo",
                    "Juan José Castro"
                ],
                "Florida" => [
                    "Florida",
                    "Sarandí Grande",
                    "25 de Mayo",
                    "Fray Marcos",
                    "Casupá",
                    "Mendoza",
                    "Alejandro Gallinal"
                ],
                "Lavalleja" => [
                    "Minas",
                    "José Pedro Varela",
                    "Solís de Mataojo",
                    "Mariscala",
                    "Pirarajá",
                    "Zapicán",
                    "Villa Serrana"
                ],
                "Maldonado" => [
                    "Maldonado",
                    "Punta del Este",
                    "San Carlos",
                    "Piriápolis",
                    "Pan de Azúcar",
                    "Aiguá",
                    "Garzón"
                ],
                "Montevideo" => [
                    "Montevideo",
                    "Ciudad Vieja",
                    "Centro",
                    "Pocitos",
                    "Punta Carretas",
                    "Carrasco",
                    "Malvín"
                ],
                "Paysandú" => [
                    "Paysandú",
                    "Guichón",
                    "Quebracho",
                    "Lorenzo Geyres",
                    "Porvenir",
                    "Tambores",
                    "Cerro Chato"
                ],
                "Río Negro" => [
                    "Fray Bentos",
                    "Young",
                    "Nuevo Berlín",
                    "San Javier",
                    "Algorta",
                    "Grecco",
                    "Bellaco"
                ],
                "Rivera" => [
                    "Rivera",
                    "Tranqueras",
                    "Vichadero",
                    "Minas de Corrales",
                    "La Puente",
                    "Masoller",
                    "Cerro Pelado"
                ],
                "Rocha" => [
                    "Rocha",
                    "Chuy",
                    "Castillos",
                    "La Paloma",
                    "Cabo Polonio",
                    "Punta del Diablo",
                    "Velázquez"
                ],
                "Salto" => [
                    "Salto",
                    "Constitución",
                    "Belén",
                    "Fernández Crespo",
                    "Rincón de Valentín",
                    "Biassini",
                    "Campo de Todos"
                ],
                "San José" => [
                    "San José de Mayo",
                    "Ciudad del Plata",
                    "Libertad",
                    "Ecilda Paullier",
                    "Rodríguez",
                    "Rafael Perazza",
                    "Puntas de Valdez"
                ],
                "Soriano" => [
                    "Mercedes",
                    "Dolores",
                    "Cardona",
                    "José Enrique Rodó",
                    "Villa Soriano",
                    "Palmitas",
                    "Risso"
                ],
                "Tacuarembó" => [
                    "Tacuarembó",
                    "Paso de los Toros",
                    "San Gregorio de Polanco",
                    "Ansina",
                    "Tambores",
                    "Laureles",
                    "Achar"
                ],
                "Treinta y Tres" => [
                    "Treinta y Tres",
                    "Vergara",
                    "Santa Clara de Olimar",
                    "Cerro Chato",
                    "Villa Sara",
                    "Mendizábal",
                    "Rincón"
                ]
            ]
        ];
        foreach ($paises as $pais => $provincias) {
            $paisActual = Pais::query()->where('nombre', 'like', "%$pais%")->first();

            foreach ($provincias as $provincia => $ciudades) {
                $provinciaActual = Provincia::query()
                    ->where('pais_id', $paisActual->id)
                    ->where('nombre', 'like', "%$provincia%")
                    ->first();

                foreach ($ciudades as $ciudad) {
                    Ciudad::create([
                        'nombre' => $ciudad,
                        'provincia_id' => $provinciaActual->id
                    ]);
                }
            }
        }
    }
}
