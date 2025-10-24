extends CharacterBody2D
class_name Jugador

@export var damage: PackedScene

@onready var animated_sprite: AnimatedSprite2D = $AnimatedSprite2D
@onready var interactivo: Area2D = $Direccion/Interactivo
@onready var progress_bar: ProgressBar = $ProgressBar

@export var sprite_hombre: SpriteFrames
@export var sprite_mujer: SpriteFrames

@export var puede_mover: bool = true
@export var bullet_node: PackedScene

@export var hombre_enfermo: SpriteFrames
@export var hombre_enfermo2: SpriteFrames
@export var mujer_enferma: SpriteFrames
@export var mujer_enferma2: SpriteFrames

var velocidad = 800 #normal: 250, combate: 350
var direccion_actual = "abajo"
var skip_next_anim_update = false
var walk_speed = 50
var sprint_speed = 80
var health: = 1000:
	set(value):
		health = value
		progress_bar.value = value

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
		
		genero_avatar()
		
		#if Estados.escuela_oscura == 2:
			#velocidad = 175
		#else:
			#velocidad = 250
	
	if progress_bar.value == 0:
		Estados.jugador_murio = true
		get_tree().change_scene_to_file("res://escenas/transicion_boss.tscn")

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

func _input(event):
	if event.is_action_pressed("shoot") and Estados.puede_disparar:
		shoot()
		Estados.puede_disparar = false
		await get_tree().create_timer(1.0).timeout
		Estados.puede_disparar = true
	else:
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
	if get_tree().current_scene.name == "Arena":
		progress_bar.show()
	else:
		progress_bar.hide()
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
			if Estados.escuela_oscura == 0:
				animated_sprite.sprite_frames = sprite_hombre
			elif Estados.escuela_oscura == 1:
				animated_sprite.sprite_frames = hombre_enfermo
			elif Estados.escuela_oscura == 2:
				animated_sprite.sprite_frames = hombre_enfermo2
		"Alexa":
			if Estados.escuela_oscura == 0:
				animated_sprite.sprite_frames = sprite_mujer
			elif Estados.escuela_oscura == 1:
				animated_sprite.sprite_frames = mujer_enferma
			elif Estados.escuela_oscura == 2:
				animated_sprite.sprite_frames = mujer_enferma2

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

func shoot():
	var bullet = bullet_node.instantiate()
 
	bullet.position = global_position
	bullet.direction = (get_global_mouse_position() - global_position).normalized()
	get_tree().current_scene.call_deferred("add_child",bullet)

func player_damage():
	var value = randi_range(5, 20)
	health -= value
	var daño = damage.instantiate()
	get_tree().current_scene.add_child(daño)
	daño.global_position = self.global_position
	daño.get_node("Label").text = str(value)
