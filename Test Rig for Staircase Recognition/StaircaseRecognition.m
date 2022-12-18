
% Check Python Version
pe = pyenv('Version', 'C:\Users\User\AppData\Local\Programs\Python\Python38\python.exe');
pe.Version;

% Declare filepath to model (runs in a .py script)
py_filename = "RunModel.py"; % Have to make sure we are in the directory (Add to path)

show_availwebcam = webcamlist;
if show_availwebcam{1} == "Webcam" % If webcam detected
    select_cam = webcam(1) % Select Webcam to activate
else
    select_cam = webcam(2)
end

i = 0;
prompt = "Run Model? (y/n/exit): ";
prompt1= "Name your image: ";
preview(select_cam) % Preview webcam

x = input(prompt, "s");

while i == 0
    
    if x == "y"

        y = input(prompt1, "s");

        imgcaptured = snapshot(select_cam); % Acquire a Frame using the snapshot function
        imshow(imgcaptured)
        saved_imgname = strcat(y,'.jpg');
        imwrite(imgcaptured, saved_imgname);

        input_tomodel = strcat(py_filename, " '" ,saved_imgname, "'");
        prediction = pyrunfile(input_tomodel, "model_output");
        
        prediction_inarray = single(prediction);

        % Prediction should output as percentage
        disp('Prediction as Ascending: ')
        disp(num2str(prediction_inarray(1)))
        disp('Prediction as Descending: ')
        disp(num2str(prediction_inarray(2)))
        disp('Prediction as No Stairs: ')
        disp(num2str(prediction_inarray(3)))

        [pred_value, pred_index] = max(prediction_inarray);
        pred_index = int16(pred_index);

        % if variable name is input will get confused for indexing with
        % input(prompt) for cmd line input
        
        disp(newline)
        disp('==================')
        disp('Final Prediction: ')
        if pred_index == 1
            disp("Ascending")
        elseif pred_index == 2
            disp("Descending")
        else
            disp("NoStairs")
        end
        disp(newline)

        x = "n";

    elseif x == "exit"  
        clear select_cam % Deactivate webcam
        i = 1; % Exit loop

    else % x == "n"
        x = input(prompt, "s");
    end

end
