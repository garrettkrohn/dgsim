import React, { useState } from 'react';
// @ts-ignore
import { SliderPicker } from 'react-color';

const ProfilePage = () => {
  const [backgroundColor, setBackgroundColor] = useState('#FF0000');
  const [foregroundColor, setForegroundColor] = useState('#FF0000');

  const handleBackgroundChangeComplete = (event: any) => {
    setBackgroundColor(event.hex);
  };

  const handleForegroundChangeComplete = (event: any) => {
    setForegroundColor(event.hex);
  };

  return (
    <div className="flex justify-center text-dgsoftwhite">
      <div className="w-80 py-4">
        <div className="py-4">
          <div>Select Background Color:</div>
          <SliderPicker
            color={backgroundColor}
            onChangeComplete={handleBackgroundChangeComplete}
          />
        </div>
        <div className="py-4">
          <div>Select Foreground Color:</div>
          <SliderPicker
            color={foregroundColor}
            onChangeComplete={handleForegroundChangeComplete}
          />
        </div>
        <div className="flex flex-col">
          <div>Preview</div>
          <div
            style={{
              backgroundColor: backgroundColor,
              width: 250,
              height: 250,
            }}
          >
            Background
          </div>
          <div
            style={{
              backgroundColor: foregroundColor,
              width: 250,
              height: 250,
            }}
          >
            Foreground
          </div>
        </div>
      </div>
    </div>
  );
};

export default ProfilePage;
