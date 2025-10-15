extends CharacterBody2D

class_name Jugador
@onready var animated_sprite: AnimatedSprite2D = $AnimatedSprite2D
@onready var interactivo: Area2D = $Direccion/Interactivo

@export var sprite_hombre: SpriteFrames
@export var sprite_mujer: SpriteFrames

@export var puede_mover: bool = true

@export var hombre_enfermo: SpriteFrames
@export var mujer_enferma: SpriteFrames

var velocidad = 350
var direccion_actual = "abajo"
var skip_next_anim_update = false
var walk_speed = 50
var sprint_speed = 80

func _physics_process(_delta):
	if not puede_mover:
		return
	else:
		var input_vector = Vector2(
			Input.get_action_strength("ui_right") - Input.get_action_strength("ui_left"),
			Input.get_action_strength("ui_down") - Input.get_action_strength("ui_up")
		).normalized()
		velocity = input_vector * velocidad

		update_anim(input_vector)
		move_and_slide()

func _unhandled_input(_event: InputEvent) -> void:
	if Input.is_action_just_pressed("ui_accept"):
		var interactuables = interactivo.get_overlapping_areas()
		if interactuables.size() > 0:

			set_process(false)
			set_physics_process(false)

			animated_sprite.play("quieto_" + direccion_actual)
			interactuables[0].action()

			DialogueManager.dialogue_ended.connect(
				func(_arg):
					set_process(true)
					set_physics_process(true),
				CONNECT_ONE_SHOT
			)
			return

func update_anim(direction: Vector2):
	var anim = $AnimatedSprite2D

	if direction == Vector2.ZERO:
		anim.play("quieto_" + direccion_actual)
	else:
		if abs(direction.x) > abs(direction.y):
			if direction.x > 0:
				direccion_actual = "derecha"
				anim.play("mov_derecha")
			else:
				direccion_actual = "izquierda"
				anim.play("mov_izquierda")
		else:
			if direction.y > 0:
				direccion_actual = "abajo"
				anim.play("mov_abajo")
			else:
				direccion_actual = "arriba"
				anim.play("mov_arriba")

func _ready():
	genero_avatar()
	NavegacionManager.on_trigger_player_spawn.connect(_on_spawn)
	match get_tree().current_scene.name:
		"piso2":
			if Estados.decision3_tomada == true:
				_on_spawn(Vector2(2882, 90), "arriba")
		"bathroom1":
			NavegacionManager.trigger_player_spawn(Vector2(-63,-34), "arriba")

func genero_avatar():
	match Estados.nom:
		"Alex":
			if Estados.escuela_oscura:
				animated_sprite.sprite_frames = hombre_enfermo
			else:
				animated_sprite.sprite_frames = sprite_hombre
		"Alexa":
			if Estados.escuela_oscura:
				animated_sprite.sprite_frames = mujer_enferma
			else:
				animated_sprite.sprite_frames = sprite_mujer

func activar_movimiento(activado: bool):
	puede_mover = activado
	if activado == false:
		skip_next_anim_update = true
		animated_sprite.play("quieto_" + direccion_actual)
	set_physics_process(activado)
	
func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

func _on_spawn(posicion: Vector2, direccion: String):
	global_position = posicion
	direccion_actual = direccion
	animated_sprite.play("quieto_" + direccion)
	skip_next_anim_update = true
