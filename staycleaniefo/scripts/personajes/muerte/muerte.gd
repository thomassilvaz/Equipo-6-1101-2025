extends CharacterBody2D

@export var damage: PackedScene
@export var jugador: Node2D

@onready var player = get_parent().find_child("jugador")
@onready var animated_sprite = $AnimatedSprite2D
@onready var progress_bar = $UI/ProgressBar
@onready var nav_agent := $NavigationAgent2D as NavigationAgent2D

var direction : Vector2
const velocidad = 200

#variable de los puntos de vida del boss, que determina el valor de otros nodos
var health: = 10000:
	set(value):
		health = value
		progress_bar.value = value
		if value <= 0:
			progress_bar.visible = false
			find_child("FiniteStateMachine").change_state("Death")


func _ready():
	set_physics_process(false) #desactiva su movimiento hasta activarse manualmente
	makepath() #planea su ruta hasta el jugador
 
#calcula la orientacion del boss respecto al jugador y voltea el sprite acorde
func _process(_delta):
	direction = player.position - position
 
	if direction.x < 0:
		animated_sprite.flip_h = true
	else:
		animated_sprite.flip_h = false

func _physics_process(_delta: float) -> void:
	var next_path_pos := nav_agent.get_next_path_position() #usa el nodo de navegacion para llamar una nueva ruta hacia el jugador
	var dir := global_position.direction_to(next_path_pos)
	velocity = dir * velocidad #se mueve respecto a la direccion y velocidad indicada
	move_and_slide()

#marca la posicion del jugador para ser detectado por el nodo de navegacion
func makepath():
	nav_agent.target_position = jugador.global_position

#al ser atacado, este recibe daño aleatorio con posibilidad de ataque critico
func take_damage():
	var value: int
	if randi() % 10 == 1:
		value = 144
	else:
		value = randi_range(50,100)
	health -= value
	var daño = damage.instantiate() #muestra visualmente cuanta vida se le quitó al boss
	get_tree().current_scene.add_child(daño)
	daño.global_position = self.global_position
	daño.get_node("Label").text = str(value)

#despues del intervalo determinado, vuelve a planear su ruta hacia el jugador
func _on_timer_timeout() -> void:
	makepath()

#al ser llamado cambia de escena y declara que se puede mostrar el final redimido
func died():
	EfectoTransicion.transition()
	await EfectoTransicion.on_transition_finished
	Estados.redimido = true
	get_tree().change_scene_to_file("res://escenas/transicion_boss.tscn")
