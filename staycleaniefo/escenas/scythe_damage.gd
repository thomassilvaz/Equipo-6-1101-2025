extends Area2D

@export var damage_interval: float = 1.0
var damage_timer: Timer

func _ready() -> void:
	damage_timer = Timer.new()
	add_child(damage_timer)
	damage_timer.wait_time = damage_interval
	damage_timer.timeout.connect(_on_damage_tick)
	disable_attack()

func enable_attack():
	monitoring = true

func disable_attack():
	monitoring = false
	damage_timer.stop()

func _on_body_entered(body):
	if body is Jugador:
		body.player_damage()
		if damage_timer.is_stopped():
			damage_timer.start()

func _on_body_exited(body):
	if body is Jugador:
		if monitoring:
			if get_overlapping_bodies().filter(func(b): return b is Jugador).is_empty():
				damage_timer.stop()

func _on_damage_tick():
	for body in get_overlapping_bodies():
		if body is Jugador:
			body.player_damage()
