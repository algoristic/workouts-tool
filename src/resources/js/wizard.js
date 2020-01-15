user = sessionStorage["username"];

mode = {
    none: '',
    create: 'create',
    update: 'update',
    saved: 'saved'
}

context = {
    none: {
        id: 'tab-none',
        name: '',
        mainPanel: true
    },
    overview: {
        id: 'overview',
        name: 'Overview',
        mainPanel: true
    },
    warmup: {
        id: 'workout-type-selection',
        name: 'Warmup',
        dbContext: 'pre_training',
        mainPanel: false
    },
    mainWorkout: {
        id: 'workout-type-selection',
        name: 'Main Workout',
        dbContext: 'main_training',
        mainPanel: false
    },
    cooldown: {
        id: 'workout-type-selection',
        name: 'Cooldown',
        dbContext: 'post_training',
        mainPanel: false
    }
}

wizard = $('#training-day-wizard');

wizard.id = {
    get: () => {
        return wizard.attr('training-day-id');
    },
    set: (newId) => {
        wizard.attr('training-day-id', newId);
    }
}
wizard.mode = {
    get: () => {
        return wizard.attr('edit-mode');
    },
    set: (newMode) => {
        wizard.attr('edit-mode', newMode);
    }
}
wizard.context = {
    get: () => {
        return wizard.activeContext;
    },
    set: (newContext) => {
        wizard.activeContext = newContext;
        wizard.attr('edit-context', newContext.id);
        $('#training-day-subtype').text(newContext.name);
        wizard.find('.active').removeClass('active');
        wizard.find(('#' + newContext.id)).addClass('active');
        if(newContext.mainPanel) {
            $('#main-control').removeClass('d-none');
            $('#sub-control').addClass('d-none');
        } else {
            $('#main-control').addClass('d-none');
            $('#sub-control').removeClass('d-none');
        }
    }
}
wizard.trainingDay = {
    get: () => {
        return wizard.attr('training-day');
    },
    set: (newTrainingDay) => {
        wizard.attr('training-day', newTrainingDay);
    }
}
wizard.workoutType = {
    get: () => {
        return $('.workout-type.active').attr('id');
    },
    set: (workoutType) => {
        wizard.find('.active').removeClass('active');
        $('.workout-type.active').removeClass('active');
        $('#' + workoutType).addClass('active');
    }
}
wizard.newTraining = () => {
    wizard.mode.set(mode.create);
    wizard.trainingDay.set((routines.lastDay() + 1));
    wizard.context.set(context.overview);
    api.createTraining(user, wizard.trainingDay.get(), function(response) {
        wizard.id.set(response.id);
    });
}
wizard.loadTraining = (training) => {
    wizard.mode.set(mode.update);
    wizard.context.set(context.overview);
    if(training.attr('pre-training-id')) {
        wizard.overview('warmup', training, 'pre');
    } else {
        wizard.addButton('warmup');
    }
    if(training.attr('main-training-id')) {
        wizard.overview('main-workout', training, 'main');
    } else {
        wizard.addButton('main-workout');
    }
    if(training.attr('post-training-id')) {
        wizard.overview('post-workout', training, 'post');
    } else {
        wizard.addButton('post-workout');
    }
}
wizard.overview = (position, training, apiWorkoutKey) => {
    $('#add-' + position + '-btn').addClass('d-none');
    $('#' + position + '-overview').removeClass('d-none');

    //$('#' + position + '-overview .description');
}
wizard.addButton = (position) => {
    $('#add-' + position + '-btn').removeClass('d-none');
    $('#' + position + '-overview').addClass('d-none');
}
wizard.clear = () => {
    wizard.context.set(context.none);
    wizard.mode.set(mode.none);
    wizard.trainingDay.set('');
    wizard.id.set('');
}
wizard.clearWorkout = (workoutType) => {

}
wizard.save = () => {
    wizard.mode.set(mode.saved);
    wizard.clear();
}
wizard.cancel = () => {
    if(wizard.mode.get() === mode.create) {
        api.deleteTraining(wizard.id.get());
    }
    wizard.clear();
}
wizard.on('hide.bs.modal', function() {
    wizard.cancel();
});
