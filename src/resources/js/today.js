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
            alert('skipWholeDay');
        }
    },
    'skipThisWorkout': {
        text: 'Skip This Workout',
        icon: 'times',
        color: 'warning',
        fn: () => {
            alert('skipThisWorkout');
        }
    },
    'skipToNextWorkout': {
        text: 'Skip To Next Day',
        icon: 'forward',
        color: 'warning',
        fn: () => {
            alert('skipToNextWorkout');
        }
    },
    'markAsDone': {
        text: 'Mark As Done',
        icon: 'check',
        color: 'success',
        fn: () => {
            alert('markAsDone');
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

displayButtons = (category) => {
    let categoryContext = trainingContext[category];
    categoryContext.buttons.forEach(function(index) {
        let button = buttons[index];
        let buttonHTML = $('<button/>', {
            text: button.text,
            class: ('btn btn-block btn-' + button.color)
        });
        buttonHTML.click(function() {
            button.fn();
        });
        $('<i/>', {
            class: ('ml-2 fas fa-' + button.icon)
        }).appendTo(buttonHTML);
        buttonHTML.appendTo($('#workout-controls'));
    });
}

displayTraining = (trainingVar) => {
    currentTraining = routineContext[trainingVar.name];
    $('<h2/>', {
        text: currentTraining.title
    }).appendTo($('#head'));
}

$(function() {
    displayButtons(category);
    displayTraining(training);
});
