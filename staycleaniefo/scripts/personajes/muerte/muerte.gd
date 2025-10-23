extends CharacterBody2D

@export var damage: PackedScene
@export var jugador: Node2D

@onready var player = get_parent().find_child("jugador")
@onready var animated_sprite = $AnimatedSprite2D
@onready var progress_bar = $UI/ProgressBar
@onready var nav_agent := $NavigationAgent2D as NavigationAgent2D

var direction : Vector2
const velocidad = 200

var health: = 10000:
	set(value):
		health = value
		progress_bar.value = value
		if value <= 0:
			progress_bar.visible = false
			find_child("FiniteStateMachine").change_state("Death")
 
func _ready():
	set_physics_process(false)
	makepath()
 
 
func _process(_delta):
	direction = player.position - position
 
	if direction.x < 0:
		animated_sprite.flip_h = true
	else:
		animated_sprite.flip_h = false
 
func _physics_process(_delta: float) -> void:
	var next_path_pos := nav_agent.get_next_path_position()
	var dir := global_position.direction_to(next_path_pos)
	velocity = dir * velocidad
	move_and_slide()


func makepath():
	nav_agent.target_position = jugador.global_position

func take_damage():
	var value: int
	if randi() % 10 == 1:
		value = 144
	else:
		value = randi_range(50,100)
	health -= value
	var daño = damage.instantiate()
	get_tree().current_scene.add_child(daño)
	daño.global_position = self.global_position
	daño.get_node("Label").text = str(value)


func _on_timer_timeout() -> void:
	makepath()
