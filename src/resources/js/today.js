reload = (response) => {
    window.location.reload(true);
}

routineContext = {
    'pre': {
        title: 'Warmup'
    },
    'main': {
        title: 'Main Workout'
    },
    'post': {
        title: 'Cooldown'
    },
    'finished': {
        title: 'Congratulations!'
    }
}
buttons = {
    'skipWholeDay': {
        text: 'Skip Whole Day',
        icon: 'times',
        color: 'danger',
        fn: () => {
            let routineId = controls.getRoutineId();
            api.skipRoutine(routineId, function(response) {
                reload();
            });
        }
    },
    'skipThisWorkout': {
        text: 'Skip This Workout',
        icon: 'times',
        color: 'warning',
        fn: () => {
            if(controls.isLastStep()) {
                let routineId = controls.getRoutineId();
                api.skipRoutine(routineId, function(response) {
                    reload();
                });
            } else {
                let trainingId = controls.getTrainingId();
                api.skipTraining(trainingId, function(response) {
                    reload();
                });
            }
        }
    },
    'skipToNextWorkout': {
        text: 'Skip To Next Day',
        icon: 'forward',
        color: 'warning',
        fn: () => {
            let trainingId = controls.getTrainingId();
            let day = controls.getDay();
            let allDays = controls.getAllDays();
            if(day === allDays) {
                day = 1;
            } else {
                day++;
            }
            api.setTrainingStep(trainingId, day, function(response) {
                reload();
            });
        }
    },
    'anotherRandomWorkout': {
        text: 'Get Another Random Workout',
        icon: 'forward',
        color: 'secondary',
        fn: () => {
            reload();
        }
    },
    'markAsDone': {
        text: 'Mark As Done',
        icon: 'check',
        color: 'success',
        fn: () => {
            let trainingId = controls.getTrainingId();
            if(controls.hasDay()) {
                let day = controls.getDay();
                let allDays = controls.getAllDays();
                if(day === allDays) {
                    day = 1;
                } else {
                    day++;
                }
                api.setTrainingStep(trainingId, day);
            }
            if(controls.isLastStep()) {
                let routineId = controls.getRoutineId();
                api.finishRoutine(trainingId, routineId, function(response) {
                    reload();
                });
            } else {
                api.finishTraining(trainingId, function(response) {
                    reload();
                });
            }
        }
    }
};
trainingContext = {
    'single_workouts': {
        buttons: [
            'markAsDone',
            'skipThisWorkout',
            'skipWholeDay',
        ]
    },
    'program_workouts': {
        buttons: [
            'markAsDone',
            'skipToNextWorkout',
            'skipThisWorkout',
            'skipWholeDay'
        ]
    },
    'finished': {
        buttons: []
    }
};

controls = $('#workout-controls');

controls.isLastStep = () => {
    return (controls.attr('is-last-step') === 'true');
}

controls.getTrainingId = () => {
    return training.id;
}

controls.getRoutineId = () => {
    return controls.attr('routine');
}

controls.hasDay = () => {
    return (controls.attr('day') !== undefined);
}

controls.getDay = () => {
    return parseInt(controls.attr('day'));
}

controls.getAllDays = () => {
    return parseInt(controls.attr('all-days'));
}

displayButtons = (category) => {
    let categoryContext = trainingContext[category];
    categoryContext.buttons.forEach(function(index) {
        let button = buttons[index];
        let buttonHTML = $('<button/>', {
            id: index,
            text: button.text,
            class: ('btn btn-block btn-' + button.color)
        });
        buttonHTML.click(function() {
            button.fn();
        });
        $('<i/>', {
            class: ('ml-2 fas fa-' + button.icon)
        }).appendTo(buttonHTML);
        buttonHTML.appendTo(controls);
    });
}

displayTraining = (trainingVar) => {
    currentTraining = routineContext[trainingVar.name];
    let options = {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    };
    $('<h3/>', {
        html: (currentTraining.title + '<small class="ml-2 text-secondary">(' + (new Date().toLocaleString('en-US', options)) + ')</small>')
    }).appendTo($('#head'));
}

$(function() {
    displayButtons(category);
    displayTraining(training);
});
