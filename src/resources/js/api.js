api = {
    createTraining: (userName, day, handler) => {
        api.callEnpoint('training/create', {
            'user': userName,
            'day': day
        }, handler)
    },
    deleteTraining: (id, handler) => {
        api.callEnpoint('training/delete', {
            'id': id
        }, handler);
    },
    updateTraining: (id, name, handler) => {
        api.callEnpoint('training/update', {
            'id': id,
            'name': name
        }, handler);
    },
    activateTraining: (trainingId, handler) => {
        api.callEnpoint('training/setActive', {
            'trainingId': trainingId
        }, handler);
    },
    deactivateTraining: (trainingId, handler) => {
        api.callEnpoint('training/setActive', {
            'trainingId': trainingId,
            'inactive': true
        }, handler);
    },
    deleteSubWorkout: (trainingId, trainingPosition, handler) => {
        api.callEnpoint('training/deleteSubWorkout', {
            'trainingId': trainingId,
            'trainingPosition': trainingPosition
        }, handler);
    },
    createSingleWorkout: (trainingId, workoutName, trainingPosition, handler) => {
        api.callEnpoint('workout/create', {
            'trainingId': trainingId,
            'workoutName': workoutName,
            'trainingPosition': trainingPosition
        }, handler);
    },
    createProgramWorkout: (trainingId, programName, trainingPosition, handler) => {
        api.callEnpoint('program/create', {
            'trainingId': trainingId,
            'programName': programName,
            'trainingPosition': trainingPosition
        }, handler);
    },
    getDescription: (subWorkoutId, handler) => {
        api.callEnpoint('description/get', {
            'subWorkoutId': subWorkoutId
        }, handler);
    },
    setTrainingStep: (trainingId, step, handler) => {
        api.callEnpoint('program/setStep', {
            'trainingId': trainingId,
            'step': step
        }, handler);
    },
    finishTraining: (trainingId, handler) => {
        api.callEnpoint('training/setDone', {
            'trainingId': trainingId
        }, handler);
    },
    finishRoutine: (trainingId, routineId, handler) => {
        api.callEnpoint('training/setDone', {
            'trainingId': trainingId,
            'routineId': routineId
        }, handler);
    },
    skipTraining: (trainingId, handler) => {
        api.callEnpoint('training/setDone', {
            'trainingId': trainingId,
            'skipTraining': true
        }, handler);
    },
    skipRoutine: (routineId, handler) => {
        api.callEnpoint('training/setDone', {
            'routineId': routineId,
            'skipRoutine': true
        }, handler);
    },
    callEnpoint: (endpoint, params, handler) => {
        endpoint += '?';
        let firstElem = true;
        Object.entries(params).forEach(param => {
            let [key, value] = param;
            if(!firstElem) {
                endpoint += '&';
            }
            endpoint += (key + '=' + value);
            firstElem = false;
        })
        $.ajax({
            url: ('https://workout.algoristic.de/api/' + endpoint)
        }).done((response) => {
            if(response.status === 'Error') {
                alert("An internal error occurred: Please reload the application!")
                wizard.cancel();
            } else {
                if(typeof handler !== 'undefined') {
                    handler(response);
                }
            }
        });
    }
}
