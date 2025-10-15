extends Node

var contador: int = 0

var escuela_oscura: bool = false
var escuela_oscura2: bool = false
var genero: String = "o"
var nom: String = "Alex"

#escenas_vistas
var primera_clase: bool = false
var introduccion: bool = false
var segunda_decision: bool = false
var escena_extra1: bool = false
var salon_vacio: bool = false

#decisiones
var decision_1: String
var decision_2: String
var decision_3: String
var decision_4: String
var decision_5: String

#eventos
var vendedor_bath1 := false
#var caminarconmateo1 := false
var decision2_tomada := false
var decision3_tomada := false
var escogio_pareja := false
var pc_interactuo_profe := false
var pc_interactuo_profe2 := false
var empezar_primera_clase := false
var primera_clase_hecha := false
var charla_con_valeria := false
var sustancia1 := false
var escena_divergente2 := false
var sustancia2 := false

#sprites
var profesor_andres: AnimatedSprite2D
var jugador: AnimatedSprite2D
var vendedor1: AnimatedSprite2D
var vendedor2: AnimatedSprite2D
var vendedor3: AnimatedSprite2D
var vendedora: AnimatedSprite2D
var mateo: AnimatedSprite2D
var valeria: AnimatedSprite2D

func _find_sprites():
	var tree = get_tree()
	if !tree or tree.current_scene == null:
		return
	
	var escena = tree.current_scene
	if escena:
		profesor_andres = _get_sprite(escena, "ProfesorAndres")
		jugador =_get_sprite(escena, "jugador")
		vendedor1 = _get_sprite(escena, "Vendedor1")
		mateo = _get_sprite(escena, "Mateo")
		valeria = _get_sprite(escena, "Valeria")
		vendedor3 = _get_sprite(escena, "Vendedor3")
		vendedora = _get_sprite(escena, "Vendedora")
		vendedor2 = _get_sprite(escena, "Vendedor2")

func _get_sprite(escena, nombre):
	var nodo_personaje = escena.find_child(nombre, true, false)
	return nodo_personaje.get_node("AnimatedSprite2D") if nodo_personaje else null


var game_data = {
	"played_cutscenes": {},
	"player_position": {"x": 0, "y": 0},
}

func _ready():
	load_game()
	get_tree().tree_changed.connect(_find_sprites)
	_find_sprites()

func reputacion(valor: int):
	if not jugador:
		return
	
	var puntaje = jugador.get_parent().get_node("Camera2D/Puntaje")
	contador += valor
	puntaje.text = str(contador)
	
	if contador == 0:
		puntaje.modulate = Color.DODGER_BLUE
	elif contador > 0:
		puntaje.modulate = Color.LIME_GREEN if contador > 4 else Color.AQUAMARINE
	elif contador < 0:
		puntaje.modulate = Color.RED if contador < -4 else Color.PALE_VIOLET_RED

func mark_cutscene_played(cutscene_id):
	game_data["played_cutscenes"][cutscene_id] = true
	save_game()

func has_played_cutscene(cutscene_id):
	return game_data["played_cutscenes"].get(cutscene_id, false)

func save_game():
	var json_string = JSON.stringify(game_data)
	var file = FileAccess.open("user://savegame.json", FileAccess.WRITE)
	
	if file:
		file.store_string(json_string)
		file.close()
		print("Game saved successfully!")
	else:
		push_error("Could not save game data.")

func load_game():
	if not FileAccess.file_exists("user://savegame.json"):
		print("No save file found. Starting new game.")
		return
	
	var file = FileAccess.open("user://savegame.json", FileAccess.READ)
	if file:
		var json_string = file.get_as_text()
		file.close()
		
		var json = JSON.new()
		var error = json.parse(json_string)
		
		if error == OK:
			var loaded_data = json.get_data()
			if loaded_data is Dictionary:
				game_data = loaded_data
				print("Game loaded successfully!")
			else:
				push_error("Loaded data is not a dictionary.")
		else:
			push_error("JSON Parse Error: " + json.get_error_message())
	else:
		push_error("Could not load game data.")
