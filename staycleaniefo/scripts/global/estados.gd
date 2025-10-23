extends Node

var contador: int = 0 #contador de reputacion

var escuela_oscura: int = 0 #contador de drogas consumidas para mostrar ciertos efectos
var genero: String = "a"
var nom: String = "Alexa"
var escogio_genero: bool = false
var puede_disparar := false

#escenas_vistas
var primera_clase: bool = false
var introduccion: bool = false
var segunda_decision: bool = false
var escena_extra1: bool = false
var salon_vacio: bool = false
var escena_divergente1 := false
var escena_divergente2 := false
var psicologia: bool = false
var despues_charla: bool = false
var caminar_cafeteria: bool = false
var cafeteria: bool = false
var duda: bool = false

#decisiones
var decision_1: String
var decision_2: String
var decision_3: String
var decision_4: String
var decision_5: String

#eventos
var vendedor_bath1: bool = false
#var caminarconmateo1 := false
var decision2_tomada: bool = false
var decision3_tomada: bool = false
var escogio_pareja: bool = false
var pc_interactuo_profe: bool = false
var pc_interactuo_profe2: bool = false
var empezar_primera_clase: bool = false
var primera_clase_hecha: bool = false
var charla_con_valeria: bool = false
var sustancia1: bool = false
var sustancia2: bool = false
var caf_interactuo_profe: bool = false
var caf_valeria: bool = false

#sprites
var profesor_andres: AnimatedSprite2D
var psicologa_laura: AnimatedSprite2D
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
		psicologa_laura = _get_sprite(escena, "PsicologaLaura")
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
	
	if contador == 9:
		puntaje.modulate = Color.GOLD
	elif contador == -9:
		puntaje.modulate = Color.PURPLE
	elif contador == 0:
		puntaje.modulate = Color.DODGER_BLUE
	elif contador > 0:
		puntaje.modulate = Color.LIME_GREEN if contador > 4 else Color.AQUAMARINE
	elif contador < 0:
		puntaje.modulate = Color.RED if contador < -4 else Color.PALE_VIOLET_RED
	
	var daño = puntaje.restador.instantiate()
	puntaje.add_child(daño)
	daño.position = puntaje.position + Vector2(150,100)
	daño.text = str(valor)

func _unhandled_input(_event: InputEvent) -> void:
	if Input.is_action_just_pressed("ui_fullscreen"):
		if DisplayServer.window_get_mode() == DisplayServer.WINDOW_MODE_FULLSCREEN:
			DisplayServer.window_set_mode(DisplayServer.WINDOW_MODE_WINDOWED)
		else:
			DisplayServer.window_set_mode(DisplayServer.WINDOW_MODE_FULLSCREEN)

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
