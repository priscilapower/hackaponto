import { Injectable } from '@nestjs/common';
import * as faceapi from 'face-api.js';
import { canvas, faceDetectionNet, faceDetectionOptions } from './../commons';
import { throwError } from 'rxjs';
var base64Img = require('base64-img');

@Injectable()
export class FaceService {

    private threshold: number = 0.40;
    private original;
    private current;

    async run() {
        await faceDetectionNet.loadFromDisk('weights/');
        await faceapi.nets.faceRecognitionNet.loadFromDisk('weights/');
        await faceapi.nets.faceExpressionNet.loadFromDisk('weights/');    
    }

    async create(current, original?) {

        let name = new Date().getTime();
        let filepath = await  base64Img.imgSync(current, 'images/', name);
        this.current = await canvas.loadImage(filepath);

        if(original) {
            let name = new Date().getTime();
            let filepath = await  base64Img.imgSync(original, 'images/', name);
            this.original = await canvas.loadImage(filepath);
        }
    }

    async faceSimilarity(): Promise<boolean> {
        let img1: any = await faceapi.computeFaceDescriptor(this.original)
        let img2: any = await faceapi.computeFaceDescriptor(this.current)

        return faceapi.round(faceapi.euclideanDistance(img1, img2)) < this.threshold
            ? true
            : false;
    }

    async faceExpressions(): Promise<number> {
        let result = await faceapi.detectSingleFace(this.current, faceDetectionOptions)
            .withFaceExpressions();
        return this.getExpressions(Object.values(result.expressions));
    }

    private getExpressions(expressions) {
        let goal = 0.0;
        let closest = expressions.reduce((prev, curr) =>
             (Math.abs(curr - goal) > Math.abs(prev - goal) ? curr : prev)
        );  
        return expressions.indexOf(closest);
    }

}

