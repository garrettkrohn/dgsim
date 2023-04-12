import React, { useState } from 'react';
// @ts-ignore
import { SliderPicker } from 'react-color';
import Button from '../../util/Button';

const ProfilePage = () => {
  const [backgroundColor, setBackgroundColor] = useState('#FF0000');
  const [foregroundColor, setForegroundColor] = useState('#FF0000');
  const [avatarBackground, setAvatarBackground] = useState('#FF0000');
  const [avatarText, setAvatarText] = useState('#000000');

  const handleBackgroundChangeComplete = (event: any) => {
    setBackgroundColor(event.hex);
  };

  const handleForegroundChangeComplete = (event: any) => {
    setForegroundColor(event.hex);
  };

  const handleAvatarBackgroundChangeComplete = (event: any) => {
    setAvatarBackground(event.hex);
  };

  const handleAvatarTextChangeComplete = (event: any) => {
    setAvatarText(event.hex);
  };

  return (
    <div className="flex justify-evenly text-dgsoftwhite">
      <div>
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
      <div>
        <div className="w-80 py-4">
          <div className="py-4">
            <div>Select Avatar Background Color:</div>
            <SliderPicker
              color={avatarBackground}
              onChangeComplete={handleAvatarBackgroundChangeComplete}
            />
          </div>
          <div className="py-4">
            <div>Select Avatar Text Color:</div>
            <SliderPicker
              color={avatarText}
              onChangeComplete={handleAvatarTextChangeComplete}
            />
          </div>
          <div className="flex flex-col">
            <div>Preview</div>
            <div
              className="h-24 w-24 rounded-3xl text-center text-7xl"
              style={{ background: avatarBackground, color: avatarText }}
            >
              AB
            </div>
          </div>
          <Button
            label="Save Avatar"
            onClick={() => console.log('run')}
            disable={false}
          />
        </div>
      </div>
    </div>
  );
};

export default ProfilePage;
